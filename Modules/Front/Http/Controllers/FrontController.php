<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Modules\Category\Repository\CategoryRepository;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;

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
    private function extractID($slug , $key)
    {
        return Str::before(Str::after($slug , $key.'-') , '-');
    }

}
