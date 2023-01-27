<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Course\Http\Requests\LessonRequest;
use Modules\Course\Repository\CourseRepository;
use Modules\Course\Repository\LessonRepository;
use Modules\Course\Repository\SeasonRepository;
use Modules\Media\Services\MediaFileService;

class lessonController extends Controller
{
    private $seasonRepository;
    private $courseRepository;
    private $lessonRepository;
    public function __construct(SeasonRepository $seasonRepository , CourseRepository $courseRepository , LessonRepository $lessonRepository)
    {
        $this->seasonRepository = $seasonRepository;
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
    }
    public function create($course)
    {
        $course = $this->courseRepository->findById($course);
        $this->authorize('createLesson' , $course);
        $seasons = $this->seasonRepository->getCourseSeason($course->id);
        return view('course::lessons.create' , compact('seasons' , 'course'));
    }
    public function store(LessonRequest $request , $course_id)
    {
        $course = $this->courseRepository->findById($course_id);
        $this->authorize('createLesson' , $course);
        $request->request->add(['media_id' => MediaFileService::uploadPrivate($request->file('lesson_file'))->id]);
        $this->lessonRepository->store($request , $course_id);
        return redirect()->route('dashboard.courses.details' , $course_id);
    }
    public function edit($lesson , $course)
    {
        $lesson = $this->lessonRepository->findById($lesson);
        $this->authorize('editLesson' , $lesson);
        $seasons = $this->seasonRepository->getCourseSeason($course);
        $course = $this->courseRepository->findById($course);
        return view('course::lessons.edit' , compact('lesson','seasons' , 'course'));

    }
    public function update(LessonRequest $request,$lesson_id,$course_id)
    {
        $lesson = $this->lessonRepository->findById($lesson_id);
        $this->authorize('editLesson' , $lesson);
        if ($request->hasFile('lesson_file'))
        {
            if ( $lesson->media)
                $lesson->media->delete();
            $request->request->add(['media_id' => MediaFileService::uploadPrivate($request->file('lesson_file'))->id]);
        }else
        {
            $request->request->add(['media_id' => $lesson->media_id]);
        }
        $this->lessonRepository->update($lesson_id ,$course_id, $request);
        return redirect()->back();
    }
    public function destroy($course , $lesson)
    {
        $lesson = $this->lessonRepository->findById($lesson);
        $this->authorize('deleteLesson' , $lesson);
        if ($lesson->media)
            MediaFileService::delete($lesson->media);
        $lesson->delete();
        return redirect()->back();
    }
}
