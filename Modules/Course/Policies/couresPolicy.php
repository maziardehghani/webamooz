<?php

namespace Modules\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Course\Models\courses;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;
use function Symfony\Component\Translation\t;

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
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)|
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) ;
    }
    public function edit(User $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $user->id == $course->teacher_id;
    }

    public function delete(User $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;
        return null;

    }
    public function change_confirmation_status(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;
        return null;
    }
    public function details( $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
        {
            return true;

        }elseif($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $user->id == $course->teacher->id)
        {
            return true;
        }

        return null;
    }
    public function createSeason( $user , $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
        {
            return true;
        }elseif($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $user->id == $course->teacher->id)
        {
            return true;
        }

        return null;
    }
    public function createLesson($user,$course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
        {
            return true;
        }elseif($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && $user->id == $course->teacher->id)
        {
            return true;
        }else
            return null;
    }
}
