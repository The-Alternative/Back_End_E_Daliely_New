<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderHasMealSeeder extends Seeder
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
            DB::table('order_has_meal')->insert([
                'order_id' => $faker->numberBetween(1,10),
                'meal_id' => $faker->numberBetween(1,10),
                'price' => $faker->numberBetween(100,200),
                'quantity'=>$faker->numberBetween(1, 20),
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
            ]);
        }
    }
}
