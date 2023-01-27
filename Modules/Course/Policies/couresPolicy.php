<?php

namespace Modules\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class couresPolicy
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
    public function manage(User $user)
    {
        return $user->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_TEACHER]);
    }
    public function create(User $user)
    {
        return $user->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_TEACHER]);
    }
    public function edit(User $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;

        return $user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $user->id == $course->teacher_id;
    }

    public function delete(User $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;

    }
    public function change_confirmation_status(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }
    public function details( $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        {
            return true;

        }elseif($user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $user->id == $course->teacher->id)
        {
            return true;
        }

        return null;
    }
    public function createSeason( $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        {
            return true;
        }elseif($user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $user->id == $course->teacher->id)
        {
            return true;
        }

        return null;
    }
    public function createLesson($user,$course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        {
            return true;
        }elseif($user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $user->id == $course->teacher->id)
        {
            return true;
        }else
            return null;
    }
    public function seeCourse($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        return true;

        return null;
    }
}
