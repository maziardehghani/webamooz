<?php

namespace Modules\RolePermissions\policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\RolePermissions\Models\Permission;

class RolePermissionPolicy
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
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }
    public function index($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT) ||
            $user->hasPermissionTo(Permission::PERMISSION_TEACHER)) return true;
        return null;
    }
    public function create($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }
    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }
    public function store($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }

    public function delete($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGEMENT)) return true;
        return null;
    }
}
