<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Database\Seeders\UserTableSeeders;


class DatabaseSeeder extends Seeder
{

    static $seeders = [
        RolePermissionSeeders::class,
        UserTableSeeders::class,
        CategorySeeder::class,
        SliderSeeder::class,
        UserSeeders::class,
        CourseSeeder::class,
        PaymentSeeder::class,

    ];

    public function run()
    {
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
