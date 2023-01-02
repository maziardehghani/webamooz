<?php

namespace Modules\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class lessonPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function editLesson($user,$lesson)
    {

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $lesson->course->teacher_id == $user->id)
            return true;
    }
    public function deleteLesson($user,$lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $lesson->course->teacher_id == $user->id)
            return true;
    }
}
