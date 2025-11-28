<?php

namespace Modules\RolePermissions\Repository;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function all()
    {
        return Permission::all();
    }
    public function store($permission)
    {

    }
}
