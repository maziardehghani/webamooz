<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Modules\RolePermissions\Models\Permission::$permissions as $permission)
        {
            Permission::findOrcreate($permission);
        }
   }
}
