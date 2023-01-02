<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();
//        foreach (User::$defaultUsers as $defualtUser)
//        {
//            User::firstOrcreate(['email' , $defualtUser['email']],[
//                'name' => $defualtUser['name'],
//                'email' => $defualtUser['email'],
//                'password' => bcrypt($defualtUser['email']),
//            ])->assignRole($defualtUser['role']);
//        }
    }
}
