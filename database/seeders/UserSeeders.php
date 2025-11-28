<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Illuminate\Database\Seeder;
use Modules\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Modules\RolePermissions\Models\Permission;

use Modules\Media\Services\MediaFileService;

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


        // Loop to generate multiple users
        for ($i = 0; $i < $userCount; $i++) {
            $user = User::create([
                'image_id' => $i+1, // Random media ID or null
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
                'password' => bcrypt('123'), // Default password (bcrypt'd)
                'remember_token' => Str::random(10), // Random remember token
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            $profile = public_path("img/usersProfile/person".($i+1).".jpeg");
            $uploadedFile = new UploadedFile(
                $profile,
                basename($profile),
                null,
                null,
                true // این فایل واقعی هست
            );

            $media = MediaFileService::uploadPublic($uploadedFile);

            $user->image_id = $media->id;
            $user->save();

            $user->givePermissionTo([Permission::PERMISSION_SUPER_ADMIN, Permission::PERMISSION_TEACHER])->markEmailAsVerified();


        }
    }
}
