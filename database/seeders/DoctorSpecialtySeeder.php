<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
//        for($doctor_id=1;$doctor_id<200;$doctor_id++) {
//            for ($specialty_id = 1; $specialty_id < 5; $specialty_id++) {
//                DB::table('doctor_Specialty')->insert(
//                    [
//                        'doctor_id' => $doctor_id,
//                        'specialty_id' => $specialty_id
//                    ]
//                );
//            }
//        }
=======
        for($doctor_id=1;$doctor_id<5;$doctor_id++) {
            for ($specialty_id = 1; $specialty_id < 3; $specialty_id++) {
                DB::table('doctor_Specialty')->insert(
                    [
                        'doctor_id' => $doctor_id,
                        'specialty_id' => $specialty_id
                    ]
                );
            }
        }
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
    }
}
