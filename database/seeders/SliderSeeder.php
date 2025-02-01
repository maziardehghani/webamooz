<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Modules\Slider\Models\Slider;


class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('slider')->insert([
                'banner_id' => 1,
                'title' => $faker->sentence(3),
                'priority' => $faker->randomFloat(2, 1, 10),
                'link' => $faker->optional()->url(),
                'status' => $faker->boolean,
                'type' => $faker->randomElement(Slider::$types),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
