<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantHasMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            DB::table('meal_restaurant')->insert([
                'restaurant_id' => $faker->numberBetween(1,10),
                'meal_id' => $faker->numberBetween(1,10),
                'menu_id' => $faker->numberBetween(1,10),
                'price' => $faker->numberBetween(100,2000),
                'quantity'=>$faker->numberBetween(1, 20),
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
            ]);
        }
    }
}
