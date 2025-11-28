<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Modules\User\Models\User;
use Modules\Media\Models\Media;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use Faker to generate fake data
        $faker = Faker::create();

        // Define how many users you want to create
        $userCount = 9;

        $users = [];

        // Loop to generate multiple users
        for ($i = 0; $i < $userCount; $i++) {
            $users[] = [
                'image_id' => 1, // Random media ID or null
                'name' => $faker->name, // Random name
                'email' => $faker->unique()->safeEmail, // Random unique email
                'username' => $faker->userName, // Random username
                'mobile' => '0993159196'.$i, // Random mobile number
                'cardNumber' => $faker->creditCardNumber, // Random credit card number
                'shaba' => $faker->swiftBicNumber, // Random SHABA number
                'balance' => $faker->randomNumber(4), // Random balance between 0-9999
                'telegram' => $faker->userName, // Random telegram username
                'whatsapp' => $faker->phoneNumber, // Random whatsapp number
                'ip' => $faker->ipv4, // Random IP address
                'facebook' => $faker->url, // Random Facebook URL
                'status' => $faker->randomElement(\Modules\User\Models\User::$statuses), // Random status from available statuses
                'email_verified_at' => now(), // Setting email as verified
                'password' => bcrypt('password'), // Default password (bcrypt'd)
                'remember_token' => Str::random(10), // Random remember token
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all generated users at once
        DB::table('users')->insert($users);
    }
}
