<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker ;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login_by_email()
    {
        $user = User::create(
            [
                'name' => $this->faker()->name,
                'email' => $this->faker()->safeEmail,
                'password'=> bcrypt('75640213'),

            ]
        );
        $this->post(route('login'),
            [
                'email' => $user->email,
                'password' => '75640213',

            ]
        );
        $this->assertAuthenticated();
    }

    public function test_user_can_login_by_mobile()
    {
        $user = User::create(
            [
                'name' => $this->faker()->name,
                'email' => $this->faker()->safeEmail,
                'mobile' => '9931591988',
                'password'=> bcrypt('75640213'),

            ]
        );
        $this->post(route('login'),
            [
                'email' => $user->mobile,
                'password' => '75640213',

            ]
        );
        $this->assertAuthenticated();
    }
}
