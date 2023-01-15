<?php

namespace Modules\User\policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class UserPolicy
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
    public function addPermission($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT);
    }
    public function index($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT);
    }
    public function edit($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT);
    }
    public function manageVerify($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT);
    }
    public function delete($user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT);
    }
    public function editProfile()
    {
        return auth()->check() == true;
    }
}
