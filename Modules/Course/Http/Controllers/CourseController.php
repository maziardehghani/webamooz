<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Modules\Category\Repository\CategoryRepository;
use Modules\Course\Http\Requests\CourseRequest;
use Modules\Course\Models\courses;
use Modules\Course\Policies\couresPolicy;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Media\Providers\MediaServiceProvider;
use Modules\Media\Services\MediaFileService;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    private $userRepository;
    private $categoryRepository;
    private $courseRepository;
    private $lessonRepository;

    public function __construct(UserRepository $userRepository , CategoryRepository $categoryRepository , CourseRepository $courseRepository , LessonRepository $lessonRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index()
    {
        $this->authorize('manage', courses::class);
        if (auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGE_COURSES , Permission::PERMISSION_SUPER_ADMIN]))
        {
            $courses = $this->courseRepository->paginate();
        }elseif (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES))
        {
            $courses = $this->courseRepository->getCoursesByteacherId(auth()->id());
        }

        return view('course::index' , compact('courses'));
    }

    public function create()
    {
        $this->authorize('create', courses::class);
        $teachers = $this->userRepository->getTeachers();
        $categories = $this->categoryRepository->all();

        return view('course::layouts.create' , compact('teachers' , 'categories'));
    }

    public function details($courseID)
    {
        $course = $this->courseRepository->findById($courseID);
        $this->authorize('details', $course);
        $lessons = $this->lessonRepository->paginate();
        return view('course::details' , compact('course' , 'lessons'));
    }


    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaFileService::uploadPublic($request->file('image'))->id]);
        $this->courseRepository->store($request);
        return redirect(route('dashboard.courses'));
    }


    public function show($id)
    {
        return view('course::show');
    }

    public function edit($id)
    {
        $course = $this->courseRepository->findById($id);
        $this->authorize('edit' , $course);
        $categories = $this->categoryRepository->all();
        $teachers = $this->userRepository->getTeachers();
        return view('course::layouts.edit' , compact('course' , 'categories' , 'teachers'));
    }

    public function update(CourseRequest $request, $id)
    {
        $course = $this->courseRepository->findById($id);
        $this->authorize('edit' , $course);

        if ($request->hasFile('image'))
        {
            $request->request->add(['banner_id' => MediaFileService::uploadPublic($request->file('image'))->id]);
          if ($course->banner)
              $course->banner->delete();

        }else
        {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $this->courseRepository->update($id , $request);

        return redirect(route('dashboard.courses.edit' , $id));
    }

    public function accept($id)
    {
        $this->authorize('change_confirmation_status' , courses::class);
        $this->courseRepository->UpdateConfirmStatus($id , courses::CONFIRMATION_STATUS_ACCEPTED);
        return redirect(route('dashboard.courses'));
    }
    public function reject($id)
    {
        $this->authorize('change_confirmation_status' , courses::class);
        $this->courseRepository->UpdateConfirmStatus($id , courses::CONFIRMATION_STATUS_REJECTED);
        return redirect(route('dashboard.courses'));
    }
    public function lock($id)
    {
        $this->authorize('change_confirmation_status' , courses::class);
        $this->courseRepository->UpdateStatus($id , courses::STATUS_LOCK);
        return redirect(route('dashboard.courses'));
    }


    public function destroy($id , CourseRepository $courseRepository)
    {
        $course = $courseRepository->findById($id);
        $this->authorize('edit' , $course);


        if ($course->banner)
        {
            $course->banner->delete();
        }
        $course->delete();
        return redirect(route('dashboard.courses'));

    }

}
