<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
<<<<<<< HEAD
        for ($i = 0; $i <= 200; $i++) {
=======
        for ($i = 0; $i <= 5; $i++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            DB::table('doctor_rates')->insert([
                'doctor_id' => $faker->numberBetween(1, 200),
                'rate' => $faker->numberBetween(1, 5)
            ]);
        }
    }
}
