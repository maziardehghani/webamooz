<?php

namespace Modules\Course\Repository;


use Illuminate\Support\Str;
use Modules\Course\Models\courses;
use Modules\Course\Models\lesson;

class CourseRepository
{

    public function store($value)
    {
        return courses::create([
            'title' => $value->title,
            'slug' =>  Str::slug($value->slug),
            'priority' => $value->priority,
            'banner_id' => $value->banner_id,
            'price' => $value->price,
            'percent' => $value->percent,
            'teacher_id' => $value->teacher_id,
            'type' => $value->type,
            'status' => $value->status,
            'category_id' => $value->category_id,
            'description' => $value->description,
            'confirmation_status' => courses::CONFIRMATION_STATUS_PENDING
        ]);
    }
    public function paginate()
    {
        return courses::paginate();
    }
    public function findById($id)
    {
        return courses::findOrFail($id);
    }

    public function update($id, $value)
    {
        return courses::where('id' , $id)->update([
            'title' => $value->title,
            'slug' =>  Str::slug($value->slug),
            'priority' => $value->priority,
            'banner_id' => $value->banner_id,
            'price' => $value->price,
            'percent' => $value->percent,
            'teacher_id' => $value->teacher_id,
            'type' => $value->type,
            'status' => $value->status,
            'category_id' => $value->category_id,
            'description' => $value->description,
            'confirmation_status' => courses::CONFIRMATION_STATUS_PENDING
        ]);
    }
    public function UpdateConfirmStatus($course , string $status)
    {
        return $course->update(['confirmation_status' => $status]);
    }

    public function UpdateStatus($id , string $status)
    {
        return courses::where('id' , $id)->update(['status' => $status]);
    }

    public function getCoursesByteacherId($teacher_id)
    {
        return courses::where('teacher_id' ,$teacher_id)->get();
    }
    public function latestCourses()
    {
        return courses::where('confirmation_status' , courses::CONFIRMATION_STATUS_ACCEPTED)
            ->latest()
            ->take(4)
            ->get();
    }
    public function MostViewCourses()
    {
        return courses::query()
            ->where('confirmation_status' , courses::CONFIRMATION_STATUS_ACCEPTED)
            ->orderByDesc('priority')
            ->take(8)
            ->get();
    }
    public function getDuration($course_id)
    {
        return lesson::where(['course_id' => $course_id , 'confirmation_status' => courses::CONFIRMATION_STATUS_ACCEPTED])->sum('time');
    }

    public function addStudentToCourse(courses $course, $student_id)
    {
        if (! $this->getStudentInCourseById($course , $student_id))
        {
            $course->student()->attach($student_id);
        }
    }
    public function getStudentInCourseById(courses $course, $student_id)
    {
        return $course->student()->where(['user_id' => $student_id , 'course_id' => $course->id])->first();
    }

    public function hasStudent(courses $course , $user)
    {
        return $course->student->contains($user);
    }

}
