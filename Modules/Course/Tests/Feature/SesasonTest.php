<?php

namespace Modules\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Models\Category;
use Modules\Course\Models\courses;
use Modules\Course\Models\Season;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Tests\TestCase;

class SesasonTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_permitted_user_can_see_details()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->get(route('dashboard.courses.details' , $course->id))->assertOk();

        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course->teacher_id = auth()->id();
        $course->save();
        $this->get(route('dashboard.courses.details' , $course->id))->assertOk();

        $this->actionAsSuperAdmin();
        $this->get(route('dashboard.courses.details' , $course->id))->assertOk();

    }
    public function test_not_permitted_user_can_not_see_details()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();

        $this->actionAsNormalUser();
        $this->get(route('dashboard.courses.details' , $course->id))->assertStatus(403);


        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('dashboard.courses.details' , $course->id))->assertStatus(403);

    }

    public function test_permitted_user_can_create_season()
    {

        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->post(route('dashboard.seasons.store' , $course->id) ,
            [
                'title' => 'معرفی',
                'number' => 1,
            ]);
        $this->assertEquals(1 , Season::count());

        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course->teacher_id = auth()->id();
        $course->save();
        $this->post(route('dashboard.seasons.store' , $course->id) ,
            [
                'title' => 'معرفی2',

            ]);
        $this->assertEquals(2 , Season::find(2)->number);


    }
    public function test_not_permitted_user_can_not_create_season()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();

        $this->actionAsNormalUser();
        $response = $this->post(route('dashboard.seasons.store' , $course->id) ,
            [
                'title' => 'معرفی',
                'number' => 1,
            ]);
        $response->assertStatus(403);

        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $response = $this->post(route('dashboard.seasons.store' , $course->id) ,
            [
                'title' => 'معرفی',
                'number' => 1,
            ]);
        $response->assertStatus(403);
    }
public function test_permitted_user_can_edit_season()
{
    $this->actionAsAdmin();
    $course = $this->createCourse();
    $season = $this->createSeason($course->id);

    $this->get(route('dashboard.seasons.edit' , $season->id))->assertOk();

    $this->put(route('dashboard.seasons.update' , $season->id) ,
        [
            'title' => 'معرفی2',
            'number' => 2
        ]);
        $this->assertEquals('معرفی2' , Season::first()->title);

}












    private function createSeason($course_id)
    {
          return Season::create([
                'title' => 'معرفی',
                'course_id' =>$course_id,
                'user_id' =>auth()->id(),
                'number' => 1,
                'confirmation_status' => 'pending'
            ]);
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
    private function courseData()
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
