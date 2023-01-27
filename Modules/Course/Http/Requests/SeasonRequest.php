<?php

namespace Modules\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
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

        return[
            'title' => 'required|min:3|max:193|',
            'number' => 'nullable|numeric|min:0|max:255',

        ];

    }
}
