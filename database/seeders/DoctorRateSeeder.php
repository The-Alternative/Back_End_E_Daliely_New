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
        for ($i = 0; $i <= 5; $i++) {
            DB::table('doctor_rates')->insert([
                'doctor_id' => $faker->numberBetween(1, 10),
                'rate' => $faker->numberBetween(1, 5),
                'is_active' => $faker->boolean
            ]);
=======
            for ($i = 0; $i <= 5; $i++) {
                DB::table('doctor_rates')->insert([
                    'doctor_id' => $faker->numberBetween(1, 200),
                    'rate' => $faker->numberBetween(1, 5)
                ]);
            }
>>>>>>> a9264f83549a1973c725d0e31b50e2600d61d728
        }
}
