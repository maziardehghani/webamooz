<?php

namespace Modules\Course\Http\Requests;

use App\Rules\validmobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Course\Models\courses;
use Modules\Course\Rules\ValidSeason;
use Modules\Course\Rules\ValidTeacher;
use Modules\Media\Models\Media;

class LessonRequest extends FormRequest
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
            'slug' => 'nullable|min:3|max:193|',
            'number' => 'nullable|numeric',
            'time' => 'required|numeric|min:0|max:255',
            'season_id' => ['required' , new ValidSeason()],
            'free' => 'required|boolean',
            'lesson_file' => 'required|file|mimes:'.Media::getExtensions(),
        ];

        if (request()->method() === 'PUT')
        {
            $rule['lesson_file'] = 'nullable|file|mimes:' . Media::getExtensions();
        }

        return $rule;
    }
}
