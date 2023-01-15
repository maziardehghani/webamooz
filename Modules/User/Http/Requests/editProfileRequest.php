<?php

namespace Modules\User\Http\Requests;

use App\Rules\validmobile;
use Illuminate\Foundation\Http\FormRequest;
use Modules\RolePermissions\Models\Permission;

class editProfileRequest extends FormRequest
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
            'name' => ['required' , 'min:3' , 'max:190'],
            'email' => ['required' , 'min:3' , 'max:190' , 'unique:users,email,' . auth()->id()],
            'username' => ['nullable' , 'min:3' , 'max:190' , 'unique:users,email,' . auth()->id()],
            'mobile' => ['nullable',new validmobile(),'unique:users,mobile,' . auth()->id()],
            'password' => ['nullable'],
        ];

        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            $rule += [
                'cardNumber' => ['required' , 'string', 'size:16'],
                'shaba' => ['required' ,  'string' , 'size:24'],

            ];
        }
        $rule['username'] = ['required' , 'min:3' , 'max:190' , 'unique:users,email,' . auth()->id()];

        return $rule;
    }
}
