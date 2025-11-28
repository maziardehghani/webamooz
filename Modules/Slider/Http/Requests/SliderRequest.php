<?php

namespace Modules\Slider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $Rule =  [
            'title' => 'nullable|string|max:100|',
            'status' => 'required|boolean',
            'priority' => 'required|numeric|min:0',
            'link' => 'nullable|string|url|max:200',
            'banner' => 'required|file|mimes:jpg,jpeg,png|'
        ];
        if (request()->method == 'PUT')
        {
            $Rule['banner'] = 'nullable|file|mimes:jpg,jpeg,png|';
        }

        return $Rule;
    }
}
