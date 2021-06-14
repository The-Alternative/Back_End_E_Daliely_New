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
        $faker=Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('restaurants')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'social_media_id' => $faker->numberBetween(1,200),
                'location_id' =>  $faker->numberBetween(1,200),
                'rate_id' =>  $faker->numberBetween(1,200),
                'user_id' =>  $faker->numberBetween(1,200),
                'appointments_id' =>  $faker->numberBetween(1,200),
                'customer_id' =>  $faker->numberBetween(1,200),
                'type_of_restaurant_id' =>  $faker->numberBetween(1,200),
                'active_time_id' =>  $faker->numberBetween(1,200),

            ]);
            DB::table('restaurant_translations')->insert([[
                'short_description' =>$faker->sentence(5),
                'long_description' =>$faker->sentence(10),
                'restaurant_id' => $s,
                'title' => $faker->sentence(2),
                'locale' => 'en',
            ],
                [
                    'short_description' =>$faker->sentence(5),
                    'long_description' =>$faker->sentence(10),
                    'restaurant_id' => $s,
                    'title' => $faker->sentence(2),
                    'locale' => 'ar',
                ]]);

        }
    }
}
