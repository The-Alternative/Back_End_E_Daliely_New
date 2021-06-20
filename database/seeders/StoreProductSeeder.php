<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i = 1; $i <= 5; $i++) {
           DB::table('stores_products')->insertGetId([
                'store_id' => $faker->numberBetween(1, 10),
                'product_id' => $faker->numberBetween(1, 10),
                'price' => $faker->numberBetween(200, 10000),
                'quantity' => $faker->numberBetween(1, 20),
                'is_active' => $faker->boolean,
                'is_appear' => $faker->boolean,
            ]);
        }
    }
}
