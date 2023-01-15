<?php

namespace Modules\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Course\Models\courses;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class seasonPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function editSeason($user , $season)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        {
            return true;

        }elseif($user->hasPermissionTo(Permission::PERMISSION_TEACHER) && $season->course->teacher == $user->id)
        {
            return true;
        }
        return null;
    }
}
