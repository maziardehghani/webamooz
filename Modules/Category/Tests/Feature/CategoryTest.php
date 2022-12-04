<?php

namespace Modules\Category\Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Category\Models\Category;
use Modules\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_can_see_categories_panel()
    {
        $this->actionAsAdmin();
         $this->get(route('dashboard.categories'))->assertOk();
    }
    public function test_user_can_create_category()
    {
        $this->actionAsAdmin();
        $this->createCategory();

        $this->assertEquals(1 , Category::all()->count());
    }
    public function test_user_can_update_category()
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
    public function test_user_can_delete_category()
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

        }
    private function createCategory()
        {
            $this->post(route('dashboard.categories.store') , [
                'title' => $this->faker->word ,
                'slug' => $this->faker->word
            ]);

        }

}
