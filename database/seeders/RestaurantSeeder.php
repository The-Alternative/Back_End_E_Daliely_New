<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 200; $i++) {
            DB::table('restaurants')->insert([
                'is_active' =>$faker->boolean,
                'is_approved' => $faker->boolean,
                'image' => $faker->sentence(3),
                'appointment_id' => $faker->numberBetween(1, 200),
                'social_media_id' =>$faker->numberBetween(1, 200),
                'active_time_id' => $faker->numberBetween(1, 200),
                'location_id' => $faker->numberBetween(1, 200),
                'customer_id' => $faker->numberBetween(1, 200),
                'type_of_restaurant_id' => $faker->numberBetween(1, 200),
                'food_id' => $faker->numberBetween(1, 200),

            ]);
        }
    }
}
