<?php

namespace Modules\RolePermissions\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\RolePermissions\Models\Permission;
use Modules\RolePermissions\Models\Role;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_permitted_user_can_see_index()
    {
        $this->actionAsAdmin();
        $this->get(route('dashboard.Role_permissions'))->assertOk();
    }
    public function test_normal_user_can_not_see_index()
    {
        $this->actionAsNormalUser();
        $this->get(route('dashboard.Role_permissions'))->assertStatus(403);
    }
    public function test_permitted_user_can_store_roles()
    {
        $this->actionAsAdmin();
        $this->post(route('dashboard.Role_permissions.store'),$this->roleData()
        )->assertRedirect(route('dashboard.Role_permissions'));

        self::assertEquals($this->count(Role::$roles)+1 , 2);
    }

    public function test_normal_user_can_not_store_roles()
    {
        $this->actionAsNormalUser();
        $this->createRole();
        $this->post(route('dashboard.Role_permissions.store'),$this->roleData()
        )->assertStatus(403);
        self::assertEquals($this->count(Role::$roles) , 1);

    }
    public function test_permitted_user_can_see_edit_roles()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->get(route('dashboard.Role_permissions.edit', $role->id)  )->assertOk();

    }
    public function test_user_can_not_see_edit_roles()
    {
        $this->actionAsNormalUser();
        $role = $this->createRole();
        $this->get(route('dashboard.Role_permissions.edit', $role->id)  )->assertStatus(403);

    }
    public function test_permitted_user_can_update_roles()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->put(route('dashboard.Role_permissions.update' , $role->id),$this->roleData()
        )->assertRedirect(route('dashboard.Role_permissions'));
        $this->assertEquals('testUpdate' , $role->fresh()->name);

    }
    public function test_normal_user_can_not_update_roles()
    {
        $this->actionAsNormalUser();
        $role = $this->createRole();
        $this->put(route('dashboard.Role_permissions.update' , $role->id),$this->roleData()
        )->assertStatus(403);
        $this->assertEquals($role->name , $role->fresh()->name);
    }
    public function test_permitted_user_can_delete_roles()
    {
        $this->actionAsAdmin();
        $role = $this->createRole();
        $this->delete(route('dashboard.Role_permissions.destroy' , $role->id))->assertRedirect(route('dashboard.Role_permissions'));
        $this->assertEquals($this->count(Role::$roles) , Role::count());
    }
    public function test_normal_user_can_not_delete_roles()
    {
        $this->actionAsNormalUser();
        $role = $this->createRole();
        $this->delete(route('dashboard.Role_permissions.destroy' , $role->id))->assertStatus(403);
        $this->assertEquals($this->count(Role::$roles)+1 , Role::count());
    }











    private function createUser()
    {
        $user =  User::create(
            [
                'name' => $this->faker()->name,
                'email' => $this->faker()->safeEmail,
                'password'=> bcrypt('75640213'),
            ]);
        $this->actingAs($user);

    }
    private function createRole()
    {
        return Role::create(['name' => "testStore",])->syncPermissions([
            Permission::PERMISSION_MANAGE_COURSES,
            Permission::PERMISSION_TEACH
        ]);
    }
    private function actionAsAdmin()
    {
        $this->createUser();
        $this->seed(RolePermissionSeeders::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_ROLE_PERMISSIONS);
    }
    private function actionAsSuperAdmin()
    {
        $this->createUser();
        $this->seed(RolePermissionSeeders::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);
    }
    private function actionAsNormalUser()
    {
        $this->createUser();
        $this->seed(RolePermissionSeeders::class);
    }
    private function roleData()
    {
        return [
            'name' => "testUpdate",
            'permissions' => [
                Permission::PERMISSION_MANAGE_COURSES,
                Permission::PERMISSION_TEACH
            ]
        ];
    }
}
