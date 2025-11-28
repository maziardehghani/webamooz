<?php

namespace Modules\Slider\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class SliderPolicy
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
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true :null;
    }
    public function store($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true :null;
    }
    public function update($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true :null;
    }
    public function delete($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ? true :null;
    }
}
