<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSedeer extends Seeder
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
            DB::table('hospitals')->insert([
                'is_active' => 1,
                'is_approved' => 1,
                'name'=>$faker->sentence(3),
                'medical_center' => $faker->sentence(2),
                'general_hospital' => 0,
                'private_hospital' =>1,
                'location_id' =>1,
                'doctor_id' => 1

            ]);
        }
    }
}
