<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
=======
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509

class StoreProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        //
=======
        $faker=Faker::create();
        for ($i = 1; $i <= 5; $i++) {
           DB::table('stores_products')->insertGetId([
                'store_id' => $faker->numberBetween(1, 200),
                'product_id' => $faker->numberBetween(1, 200),
                'price' => $faker->numberBetween(200, 1000),
                'quantity' => $faker->numberBetween(1, 200),
                'is_active' => $faker->boolean,
                'is_appear' => $faker->boolean,
            ]);
        }
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
    }
}
