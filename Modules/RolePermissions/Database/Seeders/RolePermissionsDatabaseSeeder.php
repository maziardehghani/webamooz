<?php

namespace Modules\RolePermissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        foreach (\Modules\RolePermissions\Models\Permission::$permissions as $permission)
        {
            Permission::findOrcreate($permission);
        }

        foreach (\Modules\RolePermissions\Models\Role::$roles as $name => $role)
        {
            Role::findOrcreate($name)->givePermissionTo($role);

        }
        $user = User::first();
        $user->giveRoleTo(\Modules\RolePermissions\Models\Role::ROLE_SUPER_ADMIN);

    }
}
