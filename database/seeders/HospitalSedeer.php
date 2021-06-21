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
        for ($i = 0; $i <= 5; $i++) {
            $s =DB::table('hospitals')->insertGetId([
                'is_active' =>  $faker->boolean,
                'is_approved' =>$faker->boolean,
                'general_hospital' =>$faker->boolean,
                'private_hospital' =>$faker->boolean,
                'location_id' => $faker->numberBetween(1,10),
                'doctor_id' =>  $faker->numberBetween(1,10),

            ]);
            DB::table('hospital_translations')->insert([[
                'description' =>$faker->sentence(10),
                'hospital_id' => $s,
                'name' => $faker->sentence(4),
                'locale' => 'en',
            ],
                [
                    'description' =>$faker->sentence(10),
                    'hospital_id' => $s,
                    'name' => $faker->sentence(4),
                    'locale' => 'ar',
                ]]);
        }
    }
}
