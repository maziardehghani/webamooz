<?php

namespace Modules\Comment\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Comment\Repository\commentRepository;
use Modules\RolePermissions\Models\Permission;

class ValidCommentId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            return !is_null((new commentRepository())->findAccepted($value));
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
