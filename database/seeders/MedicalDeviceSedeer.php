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
        for ($i = 0; $i <= 20; $i++) {
            $s = DB::table('medical_devices')->insertGetId([
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'doctor_id' => $faker->numberBetween(1,200),
                'hospital_id' => $faker->numberBetween(1,200),

            ]);
            DB::table('medical_device_translation')->insert([[
                'medical_device_id'   => $s,
                'name'  => $faker->sentence(3),
                'locale'      => 'en',
            ],
                [
                    'medical_device_id'   => $s,
                    'name'  => $faker->sentence(3),
                    'locale' => 'ar',
                ]]);

        }
    }
}
