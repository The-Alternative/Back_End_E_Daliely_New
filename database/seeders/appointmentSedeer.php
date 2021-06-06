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
        for ($i = 0; $i <= 200; $i++) {
            DB::table('appointments')->insert([
                'is_active' => 1,
                'is_approved' => 1,
                'description'=>$faker->sentence(10),
                'short_description' => $faker->sentence(10),
                'morning_evening' => 1,
                'active_times_id' => 1,

            ]);
        }
    }
}
