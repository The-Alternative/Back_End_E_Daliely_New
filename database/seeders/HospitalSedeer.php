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
                'is_active' =>  $faker->boolean,
                'is_approved' =>$faker->boolean,
                'name'=>$faker->sentence(3),
                'medical_center' => $faker->sentence(2),
                'general_hospital' =>$faker->boolean,
                'private_hospital' =>$faker->boolean,
                'location_id' => $faker->numberBetween(1,200),
                'doctor_id' =>  $faker->numberBetween(1,200),

            ]);
        }
    }
}
