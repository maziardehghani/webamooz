<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Category\Repository\CategoryRepository;
use Modules\Course\Models\courses;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class FrontController extends Controller
{
    public function index()
    {
        return view('front::index');
    }
    public function CourseShow($slug , CourseRepository $courseRepository , LessonRepository $lessonRepository)
    {
        $courseId = $this->extractID($slug ,'C');
        $course = $courseRepository->findById($courseId);

        $lessons = $lessonRepository->getAcceptedLessons($courseId);
        if (request()->has('lesson'))
        {
            $lessonVideo = $lessonRepository->getLesson($courseId , $this->extractID(request()->lesson , 'Eps'));
        }else
        {
            $lessonVideo = $lessonRepository->getFirstLesson($courseId);
        }
        return view('front::CourseShow' , compact('course' , 'lessons' , 'lessonVideo'));
    }
    public function TutorShow($username)
    {
        $teacher = User::permission(Permission::PERMISSION_TEACHER)->where('username' , $username)->first();

        return view('front::tutor' , compact('teacher'));
    }
    private function extractID($slug , $key)
    {
        return Str::before(Str::after($slug , $key.'-') , '-');
    }

}
