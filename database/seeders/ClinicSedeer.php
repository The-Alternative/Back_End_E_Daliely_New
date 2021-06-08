<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            $s = DB::table('clinics')->insertGetId([
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'phone_number' => $faker->phoneNumber,
                'doctor_id' =>$faker->numberBetween(1,200),
                'active_times_id' => $faker->numberBetween(1,200),
                'location_id'=>$faker->numberBetween(1,200),

            ]);
            DB::table('clinic_translation')->insert([[
                'clinic_id'   => $s,
                'name'  => $faker->sentence(3),
                'locale'      => 'en',
            ],
                [
                    'clinic_id'   => $s,
                    'name'  => $faker->sentence(3),
                    'locale' => 'ar',
                ]]);

        }
    }

}
