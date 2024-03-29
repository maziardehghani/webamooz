<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Course\Models\courses;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Course\Repository\SeasonRepository;
use Modules\RolePermissions\Models\Permission;
use Modules\Slider\Repositories\SliderRepository;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;

class FrontController extends Controller
{
    private $courseRepository;
    private $sliderRepository;
    private $userRepository;
    public function __construct(CourseRepository $courseRepository , SliderRepository $sliderRepository , UserRepository $userRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->sliderRepository = $sliderRepository;
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {
        $sliders = $this->sliderRepository->get_Banners();
        $adds = $this->sliderRepository->Adds();
        $latestCourses = $this->courseRepository->latestCourses();

        return view('front::index' , compact(['sliders', 'adds' , 'latestCourses']));
    }
    public function search()
    {
        if (!request()->searchBox)
        {
            return redirect()->back();
        }
            $courses = (new CourseRepository())->searchCourses(request()->searchBox);
            return view('front::all_courses' , compact('courses'));

    }
    public function categories($category_id)
    {
        $courses = $this->courseRepository->categoryCourses($category_id);
        return view('front::all_courses', compact('courses'));
    }
    public function CourseShow($slug , CourseRepository $courseRepository , LessonRepository $lessonRepository , SeasonRepository $seasonRepository)
    {
        $courseId = $this->extractID($slug ,'C');
        $course = $courseRepository->findById($courseId);

        $seasons = $seasonRepository->getCourseSeason($courseId);

        $lessons = $lessonRepository->getAcceptedLessons($courseId);
        if (request()->has('lesson'))
        {
            $lessonVideo = $lessonRepository->getLesson($courseId , $this->extractID(request()->lesson , 'Eps'));
        }else
        {
            $lessonVideo = $lessonRepository->getFirstLesson($courseId);
        }
        return view('front::CourseShow' , compact('course' , 'seasons','lessons' , 'lessonVideo'));
    }
    public function TutorShow($username)
    {

        $teacher = $this->userRepository->findByuserName($username);
        $teacherCourses = $this->courseRepository->getCoursesByteacherId($teacher->id);
        return view('front::tutor' , compact('teacher' , 'teacherCourses'));
    }
    public function discounterPage(courses $course)
    {
        return view('front::discounterPage' , compact('course'));
    }
    public function discount( $course_id)
    {
        $course = $this->courseRepository->findById($course_id);
        if ($course->checkCode(request()->get('code')))
        {
            $finalPriceAfterDiscount = $course->FinalPrice();
            $PercentAfterDiscount = $course->discountPercent();
            $AmountAfterDiscount = $course->discountAmount();
            return redirect()->back()->with(
                [
                    'finalPriceAfterDiscount' => $finalPriceAfterDiscount ,
                'PercentAfterDiscount' => $PercentAfterDiscount ,
                'AmountAfterDiscount' => $AmountAfterDiscount,
                    'code' => request()->get('code')
                ]);

        }

        return redirect()->back();

    }

    public function all_courses()
    {
        $courses = $this->courseRepository->all_courses();
        return view('front::all_courses' , compact('courses'));
    }

    private function extractID($slug , $key)
    {
        return Str::before(Str::after($slug , $key.'-') , '-');
    }

}
