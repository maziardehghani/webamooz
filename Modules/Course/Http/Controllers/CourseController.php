<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Repository\CategoryRepository;
use Modules\Course\Events\CourseStatusChangedEvent;
use Modules\Course\Events\newCourseCreated;
use Modules\Course\Http\Requests\CourseRequest;
use Modules\Course\Models\courses;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Media\Services\MediaFileService;
use Modules\Payment\GateWays\ZarinPal\GateWay;
use Modules\Payment\Repasitories\paymentRepository;
use Modules\Payment\Services\PaymentService;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Repositories\UserRepository;

class CourseController extends Controller
{
    private $userRepository;
    private $categoryRepository;
    private $courseRepository;
    private $lessonRepository;
    private $paymentRepository;
    private $checkCode;

    public function __construct(UserRepository $userRepository , CategoryRepository $categoryRepository , CourseRepository $courseRepository , LessonRepository $lessonRepository , paymentRepository $paymentRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        $this->authorize('manage', courses::class);
        if (auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_SUPER_ADMIN]))
        {
            $courses = $this->courseRepository->paginate();
        }elseif (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACHER))
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
        $lessons = $this->lessonRepository->getCourseLesson($courseID);
        return view('course::details' , compact('course' , 'lessons'));
    }


    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaFileService::uploadPublic($request->file('image'))->id]);
        $course = $this->courseRepository->store($request);
        event(new newCourseCreated($course));
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
        $course = $this->courseRepository->findById($id);
        $this->courseRepository->UpdateConfirmStatus($course , courses::CONFIRMATION_STATUS_ACCEPTED);
        event(new CourseStatusChangedEvent($course , courses::CONFIRMATION_STATUS_ACCEPTED));
        return redirect(route('dashboard.courses'));
    }
    public function reject($id)
    {
        $this->authorize('change_confirmation_status' , courses::class);
        $course = $this->courseRepository->findById($id);
        $this->courseRepository->UpdateConfirmStatus($course , courses::CONFIRMATION_STATUS_REJECTED);
        event(new CourseStatusChangedEvent($course , courses::CONFIRMATION_STATUS_REJECTED));
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
    public function buy($course_id)
    {

        $course = $this->courseRepository->findById($course_id);

        if (!$this->courseCanPurchased($course))
        {
            return back();
        }
        if (!$this->userCanBuyCourse($course))
        {

            return back();
        }
        $amount = $course->FinalPrice();


        if ($course->checkCode(request()->get('code')))
        {
            $this->checkCode = $course->checkCode(request()->get('code'));
            $amount = $course->FinalPrice();
        }

        if ($amount <= 0 )
        {
            $this->courseRepository->addStudentToCourse($course , auth()->id());
//            newFeedback('عملیات موفقیت امیز' , 'دوره مورد نظر با موفقیت خریداری شد' , 'success');
            return redirect()->to($course->path());
        }
        $payment = PaymentService::generate($amount , $course , auth()->user() , $course->teacher_id , $this->checkCode);

        resolve(GateWay::class)->redirect($payment->invoice_id);
    }

    private function courseCanPurchased($course)
    {
        if ($course->confirmation_status == courses::CONFIRMATION_STATUS_REJECTED)
        {
//            newFeedback('عملیات ناموفق' , 'این دوره قابل خریداری نیست!' , 'error');
            return false;
        }
        if ($course->status == courses::STATUS_LOCK)
        {
//            newFeedback('عملیات ناموفق' , 'این دوره قابل خریداری نیست!' , 'error');
            return false;
        }
        if ($course->type == courses::TYPE_FREE)
        {
//            newFeedback('عملیات ناموفق' , 'این دوره رایگان است!' , 'error');
            return false;
        }

        return true;
    }
    private function userCanBuyCourse($course)
    {
        if ($course->teacher_id == auth()->id())
        {
//            newFeedback('عملیات ناموفق' , 'شما مدرس دوره هستید' , 'error');
            return false;
        }
        if (auth()->user()->hasAccessToCourse($course))
        {
//            newFeedback('عملیات ناموفق' , 'شما به دوره دسترسی دارید' , 'error');
            return false;
        }
        return true;
    }


}
