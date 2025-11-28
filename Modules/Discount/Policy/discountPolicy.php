<?php

namespace Modules\Discount\Policy;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class discountPolicy
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
    public function manage($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true : null;
    }
    public function create($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true : null;
    }
    public function delete($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true : null;
    }
}
