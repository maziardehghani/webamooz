<?php

namespace Modules\Category\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Category\Models\Category;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_permission_holder_user_can_see_categories_panel()
    {
        $this->actionAsAdmin();
         $this->get(route('dashboard.categories'))->assertOk();
    }
    public function test_normal_user_can_not_see_categories_panel()
    {
        $this->actionAsNormalUser();
        $this->get(route('dashboard.categories'))->assertStatus(403);
    }
    public function test_permission_holder_user_can_create_category()
    {
        $this->actionAsAdmin();
       $this->createCategory();
        $this->assertEquals(1 , Category::all()->count());
    }
    public function test_permission_holder_user_can_update_category()
    {
        $newTitle = 'maziar';
        $this->actionAsAdmin();
       $this->createCategory();
        $this->assertEquals(1 , Category::all()->count());
        $this->put(route('dashboard.categories.update' ,1) , [
        'title' => $newTitle ,
        'slug' => $this->faker->word
    ]);
        $this->assertEquals(1 , Category::whereTitle($newTitle)->count());


    }
    public function test_permission_holder_user_can_delete_category()
    {
        $this->actionAsAdmin();
       $this->createCategory();
        $this->assertEquals(1 , Category::all()->count());
        $this->delete(route('dashboard.categories.destroy' , 1));
        $this->assertEquals(0 , Category::all()->count());
    }

    private function actionAsAdmin()
        {
            $user =  User::create(
                [
                    'name' => $this->faker()->name,
                    'email' => $this->faker()->safeEmail,
                    'password'=> bcrypt('75640213'),
                ]);
            $this->actingAs($user);
            $this->seed(RolePermissionSeeders::class);
            auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        }
        private function actionAsNormalUser()
        {
            $user =  User::create(
                [
                    'name' => $this->faker()->name,
                    'email' => $this->faker()->safeEmail,
                    'password'=> bcrypt('75640213'),
                ]);
            $this->actingAs($user);
            $this->seed(RolePermissionSeeders::class);
        }
        private function createCategory()
        {
            $this->post(route('dashboard.categories.store') , [
                'title' => $this->faker->word ,
                'slug' => $this->faker->word
            ]);

        }

}
