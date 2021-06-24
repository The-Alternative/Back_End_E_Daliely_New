<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorHospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        for($doctor_id=1;$doctor_id<200;$doctor_id++) {
=======
        for($doctor_id=1;$doctor_id<5;$doctor_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            for ($hospital_id = 1; $hospital_id < 3; $hospital_id++) {
                DB::table('doctor_hospital')->insert(
                    [
                        'doctor_id' => $doctor_id,
                        'hospital_id' => $hospital_id
                    ]
                );
            }
        }
    }
}
