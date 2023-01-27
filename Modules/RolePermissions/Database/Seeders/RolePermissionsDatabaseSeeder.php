<?php

namespace Modules\RolePermissions\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
    }
}
