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
        $lessonCount = 20;

        $lessons = [];

        for ($i = 0; $i < $lessonCount; $i++) {
            // Generate lesson data for each iteration
            $lessons[] = [
                'course_id' => courses::inRandomOrder()->first()->id, // Random course ID
                'user_id' => 1, // Random user ID
                'season_id' => 1 ?? null, // Random season ID or null
                'media_id' => 1, // Random media ID or null
                'free' => (bool)rand(0, 1), // Random boolean for 'free'
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
