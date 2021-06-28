<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalDeviceSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('medical_devices')->insertGetId([
<<<<<<< HEAD
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'doctor_id' => $faker->numberBetween(1,10),
                'hospital_id' => $faker->numberBetween(1,10),

            ]);
=======
                'is_active' => 1,
                'is_approved' =>1,
                'doctor_id' => 1,
                'hospital_id' => 1]);
>>>>>>> a9264f83549a1973c725d0e31b50e2600d61d728
            DB::table('medical_device_translation')->insert([[
                'medical_device_id'   => $s,
                'name'  => $faker->sentence(3),
                'description'  => $faker->sentence(8),
                'locale'      => 'en',
            ],
                [
                    'medical_device_id'   => $s,
                    'name'  => $faker->sentence(3),
                    'description'  => $faker->sentence(8),
                    'locale' => 'ar',
                ]]);
        }
    }
}
