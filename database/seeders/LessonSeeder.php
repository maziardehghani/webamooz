<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Course\Models\courses;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define how many lessons you want to create
        $lessonCount = 10;

        $lessons = [];

        for ($i = 0; $i < $lessonCount; $i++) {
            // Generate lesson data for each iteration

            $course = courses::inRandomOrder()->first();

            $lessons[] = [
                'course_id' => $course->id, // Random course ID
                'user_id' => $course->teacher_id, // Random user ID
                'season_id' => 1 ?? null, // Random season ID or null
                'media_id' => 1, // Random media ID or null
                'free' => false, // Random boolean for 'free'
                'title' => 'Lesson Title ' . ($i + 1),
                'number' => (string)($i + 1),
                'slug' => Str::slug('Lesson Title ' . ($i + 1)),
                'body' => 'This is the body text for lesson ' . ($i + 1),
                'time' => rand(20, 120), // Random time between 20 and 120 minutes
                'confirmation_status' => 'PENDING', // Or you can randomize this too if needed
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // Insert all generated lessons at once
        DB::table('lessons')->insert($lessons);
    }
}
