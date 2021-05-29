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
        for($doctor_id=1;$doctor_id<200;$doctor_id++) {
            for ($specialties_id = 1; $specialties_id < 5; $specialties_id++) {
                DB::table('doctor_Specialty')->insert(
                    [
                        'doctor_id' => $doctor_id,
                        'specialties_id' => $specialties_id
                    ]
                );
            }
        }
    }
}
