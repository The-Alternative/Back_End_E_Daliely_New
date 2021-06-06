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
        for ($i = 0; $i <= 200; $i++) {
            $s = DB::table('medical_devices')->insertGetId([
                'is_active' => 1,
                'is_approved' =>1,
                'doctor_id' => 1,
                'hospital_id' => 1

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
