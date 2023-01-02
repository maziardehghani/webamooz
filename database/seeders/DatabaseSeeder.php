<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Database\Seeders\UserTableSeeders;

class DatabaseSeeder extends Seeder
{

    static $seeders = [RolePermissionSeeders::class ,UserTableSeeders::class ];
    public function run()
    {
        foreach (self::$seeders as $seeder)
        {
            $this->call($seeder);
        }

    }
}
