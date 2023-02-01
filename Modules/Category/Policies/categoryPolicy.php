<?php

namespace Modules\Category\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class categoryPolicy
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
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)? true : null;
    }
}

