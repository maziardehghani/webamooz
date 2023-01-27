<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Modules\User\Services\VerifyCodeService;
use Tests\TestCase;

class registerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_registerForm()
    {
        $this->seed(RolePermissionSeeders::class);
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
    public function test_user_can_register()
    {
        $response = $this->post('/register' ,
        [
            'name' => 'maziarDehghani',
            'email' => 'maziardehghani1380@gmail.com',
            'mobile' => '9931591988',
            'password' => '75640213',
            'password_confirmation' => '75640213',
        ]
        );
        $response->assertRedirect(route('home'));

        $this->assertCount(1 , User::all());
    }

    public function test_user_can_verify()
    {
        $user = User::create(
            [
                'name' => 'maziarDehghani',
                'email' => 'maziardehghani1380@gmail.com',
                'password' => 'dfhgdshjfsjs',

            ]
        );

        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();

        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id , $code);

        $this->post(route('verification.verify'),[
                'verification_code' => $code
            ]);


        $this->assertEquals(true , $user->fresh()->hasVerifiedEmail());
    }
}
