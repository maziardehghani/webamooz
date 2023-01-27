<?php

namespace Modules\Course\Repository;


use Modules\Course\Models\Season;


class SeasonRepository
{

    public function store($values , $courseID)
    {
        return Season::create([
            'course_id' => $courseID,
            'user_id' => auth()->id(),
            'title' => $values->title,
            'number' => $this->getNumber($values->number, $courseID),
            'confirmation_status' => Season::CONFIRMATION_STATUS_ACCEPTED
        ]);
    }

    public function findByIdAndCourseId($seasonId , $course_id)
    {
        return Season::where('id' , $seasonId)->where('course_id' , $course_id)->get();
    }
    public function getCourseSeason($course_id)
    {
        return Season::where('course_id' , $course_id)->
        where('confirmation_status' , Season::CONFIRMATION_STATUS_ACCEPTED)->
        orderBy('number')->get();
    }
    public function findById($id)
    {
        return Season::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Season::where('id' , $id)->update([
            'title' => $values->title,
            'number' =>$this->getNumber($values->number, $id),
        ]);
    }
    public function UpdateConfirmStatus($id , string $status)
    {
        return Season::where('id' , $id)->update(['confirmation_status' => $status]);
    }

    public function UpdateStatus($id , string $status)
    {
        return Season::where('id' , $id)->update(['status' => $status]);
    }

    private function getNumber($number, $courseID)
    {
        if (is_null($number)) {
            $number = (new courseRepository())->findById($courseID)->season()->orderBy('number', 'desc')->firstOrNew()->number ?: 0;
            $number++;
        }
        return $number;
    }
}
