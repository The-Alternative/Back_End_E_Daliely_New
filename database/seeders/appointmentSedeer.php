<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class appointmentSedeer extends Seeder
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
            DB::table('appointments')->insert([
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
                'description'=>$faker->sentence(10),
                'short_description' => $faker->sentence(10),
                'morning_evening' => $faker->boolean,
                'active_times_id' => $faker->numberBetween(1,200),

            ]);
        }
    }
}
