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
            $s = DB::table('hospitals')->insertGetId([
                'is_active' => 1,
                'is_approved' => 1,
                'general_hospital' => 0,
                'private_hospital' => 1,
                'location_id' => 1,
                'doctor_id' => 1,]);

        }
        DB::table('hospital_translations')->insert([[
            'name' => $faker->sentence(5),
            'description' => $faker->sentence(5),
            'hospital_id' => $s,
              'locale' => 'en',
        ],
            [
                'name' => $faker->sentence(5),
                'description' => $faker->sentence(5),
                'hospital_id' => $s,
                'locale' => 'ar',
            ]]);

    }
}
