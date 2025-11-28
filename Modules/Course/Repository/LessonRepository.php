<?php

namespace Modules\Course\Repository;



use Illuminate\Support\Str;
use Modules\Course\Models\Lesson;


class LessonRepository
{

    public function store($values , $course_id)
    {
        return Lesson::create([
            'title' => $values->title,
            'slug' => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            'number' => $this->getNumber($values->number , $course_id),
            'time' => $values->time,
            'free' => $values->free,
            'season_id' => $values->season_id,
            'course_id' => $course_id,
            'user_id' => auth()->id(),
            'media_id' => $values->media_id,
            'body' => $values->body,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED,
        ]);
    }

    public function findByIdAndCourseId($seasonId , $course_id)
    {
        return Lesson::where('id' , $seasonId)->where('course_id' , $course_id)->get();
    }
    public function getCourselesson($course_id)
    {
        return Lesson::where('course_id' , $course_id)->
        where('confirmation_status' , Lesson::CONFIRMATION_STATUS_ACCEPTED)->
        orderBy('number')->get();
    }
    public function findById($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($lesson_id,$course_id, $values)
    {
        return Lesson::where('id' , $lesson_id)->update([
            'title' => $values->title,
            'slug' => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            'number' => $this->getNumber($values->number , $course_id),
            'time' => $values->time,
            'free' => $values->free,
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'body' => $values->body,
        ]);
    }
    public function paginate()
    {
        return Lesson::orderBy('number')->get();
    }
    public function UpdateConfirmStatus($id , string $status)
    {
        return Lesson::where('id' , $id)->update(['confirmation_status' => $status]);
    }

    public function UpdateStatus($id , string $status)
    {
        return Lesson::where('id' , $id)->update(['status' => $status]);
    }

    private function getNumber($number, $courseID)
    {
        if (is_null($number)) {
            $number = (new courseRepository())->findById($courseID)->lesson()->orderBy('number', 'desc')->firstOrNew()->number ?: 0;
            $number++;
        }
        return $number;
    }
    public function lessonCount($course_id)
    {
        return Lesson::where(['confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED , 'course_id' => $course_id])->count();
    }
    public function getAcceptedLessons($course_id)
    {
        return Lesson::where(['confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED , 'course_id' => $course_id])->get();
    }
    public function getFirstLesson( $course_id)
    {
        return Lesson::where(['confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED , 'course_id' => $course_id ])->orderBy('number' , 'asc')->first();
    }
    public function getLesson($course_id,$lessonNumber)
    {
        return Lesson::where(['course_id' => $course_id , 'number' => $lessonNumber ])->first();
    }

}
