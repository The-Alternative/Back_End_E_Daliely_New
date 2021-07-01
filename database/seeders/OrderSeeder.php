<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
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
            DB::table('orders')->insert([
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
                'total' => $faker->numberBetween(10,20),
                'date'=>$faker->date('2021-8-20'),
                'customer_id' => $faker->numberBetween(1,10),
                'meal_id' => $faker->numberBetween(1,10),

            ]);
        }
    }
}
