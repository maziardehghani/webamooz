<?php

namespace Modules\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Models\Category;
use Modules\Course\Models\courses;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Tests\TestCase;

class courseTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_permitted_user_can_see_courses()
    {
        $this->actionAsAdmin();
        $this->get(route('dashboard.courses'))->assertOk();

        $this->actionAsSuperAdmin();
        $this->get(route('dashboard.courses'))->assertOk();
    }
    public function test_normal_user_can_not_see_courses()
    {
        $this->actionAsNormalUser();
        $this->get(route('dashboard.courses'))->assertStatus(403);
    }
    public function test_permitted_user_can_create_course()
    {
        $this->actionAsAdmin();
        $this->get(route('dashboard.courses.create'))->assertOk();

        $this->actionAsSuperAdmin();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('dashboard.courses.create'))->assertOk();


    }
    public function test_normal_user_can_not_create_course()
    {
        $this->actionAsNormalUser();
        $this->get(route('dashboard.courses.create'))->assertStatus(403);

    }
    public function test_permitted_user_can_see_edit_course()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->get(route('dashboard.courses.edit', $course->id))->assertOk();

        $this->actionAsNormalUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('dashboard.courses.edit', $course->id)  )->assertOk();

    }
    public function test_user_can_not_see_edit_course()
    {
        $this->actionAsNormalUser();
        $course = $this->createCourse();
        $this->get(route('dashboard.courses.edit', $course->id)  )->assertStatus(403);

    }
    public function test_user_can_not_edit_other_course()
    {
        $this->actionAsNormalUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->actionAsNormalUser();
        $this->get(route('dashboard.courses.edit', $course->id)  )->assertStatus(403);
    }
    public function test_permitted_user_can_store_course()
    {
        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES , Permission::PERMISSION_TEACH]);
        Storage::disk('local');
        $response = $this->post(route('dashboard.courses.store') , $this->courseDate());

        $response->assertRedirect(route('dashboard.courses'));
        $this->assertEquals(1, courses::count());
    }
    public function test_normal_user_can_not_store_course()
    {
        $this->actionAsNormalUser();
        Storage::disk('local');
        $this->post(route('dashboard.courses.store') ,  $this->courseDate());
        $this->assertEquals(0, courses::count());
    }
    public function test_permitted_user_can_update_course()
    {
        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES , Permission::PERMISSION_TEACH]);
        $course = $this->createCourse();
        $response = $this->put(route('dashboard.courses.update' ,$course->id), $this->courseDate());
        $response->assertRedirect(route('dashboard.courses.edit' , $course->id));
    }
    public function test_normal_user_can_not_update_course()
    {
        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_TEACH);
        $course = $this->createCourse();
        $response = $this->put(route('dashboard.courses.update' ,$course->id), $this->courseDate());
        $response->assertStatus(403);
      }
      public function test_permitted_user_can_delete_course()
      {
          $this->actionAsNormalUser();
          auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
          $course = $this->createCourse();
          $response = $this->delete(route('dashboard.courses.destroy' , $course->id));
          $response->assertRedirect(route('dashboard.courses'));
          $this->assertEquals(courses::count() , 0);
      }
    public function test_normal_user_can_not_delete_course()
    {
        $this->actionAsNormalUser();
        $course = $this->createCourse();
        $response = $this->delete(route('dashboard.courses.destroy' , $course->id));
        $response->assertStatus(403);
        $this->assertEquals(courses::count() , 1);
    }
    public function test_permitted_user_can_change_confirmation_status_course()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $response = $this->patch(route('dashboard.courses.accept' , $course->id));
        $response->assertRedirect(route('dashboard.courses'));
        $response = $this->patch(route('dashboard.courses.accept' , $course->id));
        $response->assertRedirect(route('dashboard.courses'));
        $response = $this->patch(route('dashboard.courses.accept' , $course->id));
        $response->assertRedirect(route('dashboard.courses'));
    }
    public function test_normal_user_can_not_change_confirmation_status_course()
    {
        $this->actionAsNormalUser();
        $course = $this->createCourse();
        $response = $this->patch(route('dashboard.courses.accept' , $course->id));
        $response->assertStatus(403);

        $response = $this->patch(route('dashboard.courses.reject' , $course->id));
        $response->assertStatus(403);

        $response = $this->patch(route('dashboard.courses.locked' , $course->id));
        $response->assertStatus(403);
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
    private function actionAsAdmin()
    {
        $this->createUser();
        $this->seed(RolePermissionSeeders::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
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
    private function createCourse()
    {
        return courses::create(
            [
                'title' => $this->faker->word,
                'slug' => $this->faker->word,
                'teacher_id' => auth()->id(),
                'price' => 2000,
                'percent' => 5,
                'type' => courses::TYPE_FREE,
                'status' => courses::STATUS_LOCK,
                'confirmation_status' => courses::CONFIRMATION_STATUS_ACCEPTED,
            ]
        );
    }
    private function createCategory()
    {
        return Category::create([
            'title' => $this->faker->word ,
            'slug' => $this->faker->word
        ]);

    }
    private function courseDate()
    {
        return [
            'title' => 'afjs;f',
            'teacher_id' => auth()->id(),
            'slug' => "sfhasfh",
            'category_id' => $this->createCategory()->id,
            'price' => 3000,
            'priority' => 3,
            'percent' => 2,
            'type' => courses::TYPE_FREE,
            'image' => UploadedFile::fake()->image('bannerd.jpg'),
            'status' => courses::STATUS_COMPLETED,
            'confirmation_status' => courses::CONFIRMATION_STATUS_PENDING,
        ];
    }
}
