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

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)||
            $user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $lesson->course->teacher_id == $user->id)
            return true;
    }
    public function deleteLesson($user,$lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)||
            $user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $lesson->course->teacher_id == $user->id)
            return true;
    }
    public function download($user,$lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ||
            $user->id == $lesson->course->teacher_id ||
            $lesson->course->hasStudent($user->id)||
            $lesson->is_free()
        )
            return true;

        return false;
    }
}
