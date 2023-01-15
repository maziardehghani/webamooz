<?php

namespace Modules\Discount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Discount\Model\Discount;

class DiscountRequest extends FormRequest
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
        return [
            'code' => 'nullable|max:50',
            'percent' => 'required|numeric|min:1|max:100|',
            'usage_limitation' => 'required|numeric|min:1|max:100000',
            'expire_at' => 'required|numeric|min:1|',
            'course' => 'nullable|numeric',
            'type' => ['required' , Rule::in(Discount::$types)]

        ];
    }
}
