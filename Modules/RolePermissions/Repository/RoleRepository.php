<?php

namespace Modules\RolePermissions\Repository;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function all()
    {
        return Role::all();
    }
    public function store($request)
    {
        Role::create(['name'=> $request->name])->syncPermissions($request->permissions);
    }
    public function findById($roleID)
    {
        return Role::findOrFail($roleID);
    }
    public function update($request , $roleID)
    {
        $role = $this->findById($roleID);
        return $role->syncPermissions($request->permissions)->update(['name' =>$request->name ]);
    }
    public function delete($roleID)
    {
        $role = $this->findById($roleID);
        return $role->delete();
    }

}
