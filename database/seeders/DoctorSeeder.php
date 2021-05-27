<?php

namespace Database\Seeders;

use App\Models\Doctors\doctor;
use Database\Factories\DoctorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
//    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        for ($i = 1; $i <= 100; $i++) {
//            $s = DB::table('doctors')->insertGetId([
//                'image' => $this->faker->sentence(5),
//                'is_active' => 1,
//                'is_approved' =>1,
//                'social_media_id' => 1,
//                'hospital_id' => 1,
//                'clinic_id' => 1,
//                'specialty_id' => 1
//            ]);
//            DB::table('doctor_translations')->insert([[
//                'first_name' => $this->faker->sentence(2),
//                'last_name' => $this->faker->sentence(2),
//                'local' => 'en',
//                'description' => $this->faker->sentence(10),
//                'doctor_id' => $s
//            ],
//                [
//                    'first_name' => $this->faker->sentence(2),
//                    'last_name' => $this->faker->sentence(2),
//                    'local' => 'ar',
//                    'description' => $this->faker->sentence(10),
//                    'doctor_id' => $s
//                ]]);
//
//        }
    }
}
