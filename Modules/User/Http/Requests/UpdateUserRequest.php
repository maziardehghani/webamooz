<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Models\User;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|min:3,max:190',
            'email'=> 'required|min:3|max:190|unique:users,email,' . request()->route('user'),
            'username' => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user'),
            'mobile'=>'nullable|unique:users,mobile,' . request()->route('user'),
            'status' => ['required' ,Rule::in(User::$statuses)],
        ];
    }
}
