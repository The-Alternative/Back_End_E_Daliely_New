<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostStoreSeeder extends Seeder
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
                        DB::table('post_store')->insert(
                            [
                                'post_id' => $customer_id,
                                'store_id' => $post_id,
                                'start_date_time'=>$faker->time('21:12:31'),
                                'end_date_time' => $faker->time('21:12:31'),
                                'price' => $faker->numberBetween(1000,10000),
                                'new_price' => $faker->numberBetween(1000,10000),
                                'is_active'=>$faker->boolean,
                                'is_approved'=>$faker->boolean,
                            ]
                        );
                    }
        }
    }
}
