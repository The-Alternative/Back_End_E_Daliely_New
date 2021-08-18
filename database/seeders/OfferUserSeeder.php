<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferUserSeeder extends Seeder
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
            DB::table('offer_users')->insert([
                'is_active' => $faker->boolean,
                'offer_id'=>$faker->numberBetween(1,10),
                'user_id' => $faker->numberBetween(1,10),
                'interaction_type'=>$faker->numberBetween(1,10)
            ]);
        }
    }
}
