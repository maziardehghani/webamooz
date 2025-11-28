<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;


class UserTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (User::$defaultUsers as $User)
        {
            User::create(
                [
                'name' => $User['name'],
                'email' => $User['email'],
                'username' => $User['username'],
                'password' => bcrypt($User['password']),
            ])->givePermissionTo($User['permissions'])->markEmailAsVerified();
        }


    }
}
