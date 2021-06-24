<?php

namespace Database\Seeders;

use App\Models\Doctors\doctor;
//use Database\Factories\DoctorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
<<<<<<< HEAD
        for ($i = 0; $i <= 200; $i++) {
            $s = DB::table('doctors')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => 1,
                'is_approved' =>1,
                'social_media_id' => 1,
                'hospital_id' => 1,
                'clinic_id' => 1,
                'appointments_id' => 1,

                'specialty_id' => 1
=======
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('doctors')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'social_media_id' => $faker->numberBetween(1,200),
                'hospital_id' =>  $faker->numberBetween(1,200),
                'clinic_id' =>  $faker->numberBetween(1,200),
                'appointments_id' =>  $faker->numberBetween(1,200),

                'specialty_id' =>  $faker->numberBetween(1,200),
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ]);
            DB::table('doctor_translation')->insert([[
                'description' =>$faker->sentence(10),
                'doctor_id' => $s,
                'first_name' => $faker->sentence(2),
                'last_name'  => $faker->sentence(2),
                'locale' => 'en',
            ],
                [
                    'description' =>$faker->sentence(10),
                    'doctor_id' => $s,
                    'first_name' => $faker->sentence(2),
                    'last_name'  => $faker->sentence(2),
                    'locale' => 'ar',
                ]]);

        }
    }
}
