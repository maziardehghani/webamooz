<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Modules\Course\Models\Courses;
use Modules\Course\Models\Lesson;
use Modules\Course\Models\Season;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $courses = [
            ['title' => 'Laravel for Beginners', 'description' => 'Learn the basics of Laravel, including routing, controllers, models, and migrations. Ideal for beginners looking to build web applications.'],
            ['title' => 'Advanced PHP Development', 'description' => 'Deep dive into PHP, covering OOP, security best practices, and performance optimization techniques.'],
            ['title' => 'Mastering React.js', 'description' => 'A comprehensive course on React.js, covering hooks, state management, and building scalable front-end applications.'],
            ['title' => 'Node.js and Express Crash Course', 'description' => 'Learn how to build fast and scalable back-end applications using Node.js and Express.'],
            ['title' => 'Python for Data Science', 'description' => 'An introduction to data science using Python, covering pandas, NumPy, and data visualization techniques.'],
            ['title' => 'Machine Learning with Python', 'description' => 'Understand machine learning algorithms and build predictive models using Python libraries like scikit-learn and TensorFlow.'],
            ['title' => 'Django Web Development', 'description' => 'Learn to build web applications using Django, including authentication, ORM, and API development.'],
            ['title' => 'Flutter Mobile App Development', 'description' => 'Build cross-platform mobile applications using Flutter and Dart from scratch.'],
            ['title' => 'Full-Stack JavaScript Bootcamp', 'description' => 'Become a full-stack JavaScript developer by learning React, Node.js, Express, and MongoDB.'],
            ['title' => 'Cyber Security Essentials', 'description' => 'Understand the fundamentals of cybersecurity, including encryption, ethical hacking, and network security.'],
            ['title' => 'Java Programming Masterclass', 'description' => 'A complete Java programming guide covering core Java, multithreading, and design patterns.'],
            ['title' => 'C++ for Game Development', 'description' => 'Learn C++ programming for game development using Unreal Engine and game physics.'],
            ['title' => 'Kotlin for Android Developers', 'description' => 'Master Kotlin programming and develop native Android applications.'],
            ['title' => 'Swift for iOS Apps', 'description' => 'Learn Swift programming and build iOS applications using SwiftUI and UIKit.'],
            ['title' => 'GraphQL API Development', 'description' => 'Understand GraphQL and how to build scalable APIs with Apollo and Express.'],
            ['title' => 'DevOps with Docker and Kubernetes', 'description' => 'Learn DevOps practices, including containerization with Docker and orchestration with Kubernetes.'],
            ['title' => 'Blockchain Development with Solidity', 'description' => 'Get hands-on experience in blockchain development using Solidity and Ethereum smart contracts.'],
            ['title' => 'Artificial Intelligence with TensorFlow', 'description' => 'Learn AI concepts and build neural networks using TensorFlow and Keras.'],
            ['title' => 'WordPress Theme Development', 'description' => 'Design and develop custom WordPress themes from scratch using PHP and JavaScript.'],
            ['title' => 'UI/UX Design for Web & Mobile', 'description' => 'Master UI/UX principles and create stunning web and mobile interfaces using Figma and Adobe XD.'],
        ];

        foreach ($courses as $course) {
            $course = Courses::query()->create([
                'teacher_id' => 1, // Assuming a single teacher for simplicity
                'category_id' => 1,
                'banner_id' => $faker->optional()->numberBetween(1, 50),
                'title' => $course['title'],
                'slug' => Str::slug($course['title']),
                'priority' => $faker->optional()->randomFloat(2, 1, 10),
                'price' => (string) $faker->randomFloat(2, 10, 500),
                'percent' => (string) $faker->numberBetween(0, 100),
                'type' => $faker->randomElement(Courses::$types),
                'status' => $faker->randomElement(Courses::$statuses),
                'confirmation_status' => Courses::CONFIRMATION_STATUS_ACCEPTED,
                'description' => $course['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            $seasonCount = 5;
            // Loop to generate multiple seasons
            for ($i = 0; $i < $seasonCount; $i++) {
                $season = Season::query()->create([
                    'course_id' => $course->id, // Random course ID
                    'user_id' => 1, // Random user ID
                    'title' => 'Season ' . ($i + 1), // Dynamic title
                    'number' => $i + 1, // Sequential season number
                    'confirmation_status' => Season::CONFIRMATION_STATUS_ACCEPTED, // Default confirmation status
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $lessonCount = 10;

                $lessons = [];

                for ($j = 0; $j < $lessonCount; $j++) {
                    // Generate lesson data for each iteration
                    Lesson::query()->create([
                        'course_id' => $course->id, // Random course ID
                        'user_id' => 1, // Random user ID
                        'season_id' => $season->id ?? null, // Random season ID or null
                        'media_id' => 1, // Random media ID or null
                        'free' => (bool)rand(0, 1), // Random boolean for 'free'
                        'title' => 'Lesson ' . ($j + 1),
                        'number' => (string)($j + 1),
                        'slug' => Str::slug('Lesson ' . ($j + 1)),
                        'body' => 'This is the body text for lesson ' . ($j + 1),
                        'time' => rand(10, 40), // Random time between 20 and 120 minutes
                        'confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED, // Or you can randomize this too if needed
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                // Insert all generated lessons at once
            }


        }
    }
}
