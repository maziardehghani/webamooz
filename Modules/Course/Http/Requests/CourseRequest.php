<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Course\Models\courses;
use Modules\Course\Rules\ValidTeacher;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rule = [
            'title' => 'required|min:3|max:193|',
            'slug' => 'required|min:3|max:193|unique:courses,slug',
            'priority' => 'required|numeric',
            'price' => 'required|numeric|min:0|max:1000000|',
            'percent' => 'required|numeric|min:0|max:100',
            'teacher_id' => ['required' , 'exists:users,id' , new ValidTeacher()],
            'type' => ['required' , Rule::in(courses::$types)],
            'status' => ['required' , Rule::in(courses::$statuses)],
            'category_id' => 'required|exists:category,id',
            'image' => 'required'
        ];

        if (request()->method === 'PUT')
        {
            $rule['image'] = 'nullable|mimes:jpg,jpeg,png';
            $rule['slug'] = 'required|min:3|max:193|unique:courses,slug,' . request()->route('courses');
        }

        return $rule;
    }
}
