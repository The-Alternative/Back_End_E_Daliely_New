<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $faker=Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('specialties')->insertGetId([
                'is_active' =>  $faker->boolean,
                'graduation_year' => $faker->year,

            ]);
            DB::table('specialty_translation')->insert([[
                'specialty_id'   => $s,
                'name'  => $faker->sentence(3),
                'description'  => $faker->sentence(8),
                'locale'      => 'en',
            ],
                [
                    'specialty_id'   => $s,
                    'name'  => $faker->sentence(3),
                    'description'  => $faker->sentence(8),

                    'locale' => 'ar',
                ]]);

        }
=======
//        $faker=Faker::create();
//        for ($i = 0; $i <= 200; $i++) {
//            $s = DB::table('specialties')->insertGetId([
//                'is_active' => 1,]);
//        for ($i = 0; $i <= 5; $i++) {
//            $s = DB::table('specialties')->insertGetId([
//                'is_active' =>  $faker->boolean,
//                'graduation_year' => $faker->year,
//
//            ]);
//            DB::table('specialty_translation')->insert([[
//                'specialty_id'   => $s,
//                'name'  => $faker->sentence(3),
//                'locale'      => 'en',
//            ],
//                [
//                    'specialty_id'   => $s,
//                    'name'  => $faker->sentence(3),
//                    'locale' => 'ar',
//                ]]);
//
//        }
//    }
>>>>>>> a9264f83549a1973c725d0e31b50e2600d61d728
    }
}
