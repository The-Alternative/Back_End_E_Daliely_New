<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($post_id = 1; $post_id < 5; $post_id++) {
            for ($customer_id = 1; $customer_id < 5; $customer_id++) {
                DB::table('post_customer')->insert(
                    [
                        'customer_id' => $customer_id,
                        'post_id' => $post_id,
                        'like'=>$faker->numberBetween(1,10),
                        'share'=>$faker->numberBetween(1,10),
                        'rate'=>$faker->numberBetween(1,10),
                        'is_active'=>$faker->boolean,
                        'is_approved'=>$faker->boolean,
                    ]
                );
            }
        }
    }
}
