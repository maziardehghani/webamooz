<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Modules\Course\Models\courses;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;

class PaymentSeeder extends Seeder
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

        // Define how many payments you want to create
        $paymentCount = 100;

        $payments = [];

        // Loop to generate multiple payments
        for ($i = 0; $i < $paymentCount; $i++) {
            // Random user IDs for buyer and seller
            $buyer = User::inRandomOrder()->first();
            $seller = User::inRandomOrder()->first();


            $payments[] = [
                'buyer_id' => $buyer->id, // Random buyer ID
                'seller_id' => $seller->id, // Random seller ID
                'paymentable_id' => $faker->randomElement([1,2,3,4,5,6,7,8]), // Random paymentable ID
                'paymentable_type' => courses::class, // Paymentable model type
                'amount' => $faker->randomFloat(2, 10, 1000), // Random amount (between 10 and 1000)
                'invoice_id' => 'INV' . Str::random(8), // Random invoice ID
                'gateWay' => $faker->randomElement(['PayPal', 'Stripe', 'Bank Transfer']), // Random gateway
                'status' => $faker->randomElement(Payment::$statuses), // Random status
                'seller_percent' => $faker->numberBetween(1, 100), // Random seller percent (between 1 and 100)
                'seller_share' => 20, // Random seller share
                'site_share' => 80, // Random site share
                'created_at' => Carbon::now(),
            ];
        }

        // Insert all generated payments at once
        DB::table('payments')->insert($payments);
    }
}
