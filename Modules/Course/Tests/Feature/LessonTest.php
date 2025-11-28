<?php

namespace Modules\Course\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Modules\Category\Models\Category;
use Modules\Course\Models\courses;
use Modules\Course\Models\lesson;
use Modules\Course\Models\Season;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Database\Seeders\RolePermissionSeeders;
use Modules\User\Models\User;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_permitted_user_can_create()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->get(route('dashboard.lessons.create' , $course->id))->assertok();

        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = $this->createCourse();
        $this->get(route('dashboard.lessons.create' , $course->id))->assertOk();
    }

    public function test_normal_user_can_not_create()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $this->actionAsNormalUser();
        $this->get(route('dashboard.lessons.create' , $course->id))->assertStatus(403);

    }
    public function test_permitted_user_can_store()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $season = $this->createSeason($course->id);

        $this->post(route('dashboard.lessons.store' , $course->id) ,
            [
                'title' => $this->faker->word,
                'slug' => $this->faker->word,
                'number' => 1,
                'time' => 23,
                'season_id' =>$season->id,
                'free' => 0,
                'lesson_file' => UploadedFile::fake()->create('adsf3w4dfsj5.mp4' , 123),
            ]
        );
        self::assertEquals(1 , lesson::count());
    }

    public function test_permitted_extensions_can_store_()
    {
        $not_allow_extensions = ['jpg' , 'mp3' , 'png'];
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $season = $this->createSeason($course->id);

        foreach ($not_allow_extensions as $extension)
        {
            $this->post(route('dashboard.lessons.store' , $course->id) ,
                [
                    'title' => $this->faker->word,
                    'slug' => $this->faker->word,
                    'number' => 1,
                    'time' => 23,
                    'season_id' =>$season->id,
                    'free' => 0,
                    'lesson_file' => UploadedFile::fake()->create('adsf3w4dfsj5.' . $extension , 123),
                ]
            );
        }

        self::assertEquals(0 , lesson::count());
    }
    public function test_permitted_user_can_see_edit()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $lesson = $this->createLesson($course->id);
        $response = $this->get(route('dashboard.lessons.edit' , [$lesson->id,$course->id]));
        $response->assertStatus(500);

        $this->actionAsNormalUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = $this->createCourse();
        $lesson = $this->createLesson($course->id);
        $response = $this->get(route('dashboard.lessons.edit' , [$lesson->id,$course->id]));
        $response->assertStatus(500);

    }
    public function test_normal_user_can_not_see_edit()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $lesson = $this->createLesson($course->id);
        $this->actionAsNormalUser();
        $response = $this->get(route('dashboard.lessons.edit' , [$lesson->id,$course->id]));
        $response->assertStatus(403);
    }
    public function test_permitted_user_can_Update()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $lesson = $this->createLesson($course->id);
        $season = $this->createSeason($course->id);

        $this->put(route('dashboard.lessons.update', [$lesson->id, $course->id]),
                [
                    'title' => 'update title',
                    'slug' => $this->faker->word,
                    'number' => 1,
                    'time' => 23,
                    'season_id' => $season->id,
                    'free' => 0,
                ]);
          $this->assertEquals('update title' , lesson::find(1)->title);

    }
    public function test_permitted_user_can_delete()
    {
        $this->actionAsAdmin();
        $course = $this->createCourse();
        $lesson = $this->createLesson($course->id);
        $this->actionAsNormalUser();
        $this->delete(route('dashboard.lessons.destroy', [$course->id, $lesson->id]))->assertStatus(403);
        $this->assertEquals(1 , lesson::count());

        $this->actionAsAdmin();

        $this->delete(route('dashboard.lessons.destroy', [$course->id, $lesson->id]));
        $this->assertEquals(null , lesson::find(1));

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
    private function createLesson($course_id)
    {
        return lesson::create([
            'title' => 'ssss',
            'slug' => 'fsaf',
            'course_id' => $course_id,
            'user_id' => auth()->id(),
        ]);
    }
}
