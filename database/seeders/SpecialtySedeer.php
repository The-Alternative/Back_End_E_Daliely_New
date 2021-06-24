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
        $faker=Faker::create();
<<<<<<< HEAD
        for ($i = 0; $i <= 200; $i++) {
            $s = DB::table('specialties')->insertGetId([
                'is_active' => 1,
=======
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('specialties')->insertGetId([
                'is_active' =>  $faker->boolean,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                'graduation_year' => $faker->year,

            ]);
            DB::table('specialty_translation')->insert([[
                'specialty_id'   => $s,
                'name'  => $faker->sentence(3),
                'locale'      => 'en',
            ],
                [
                    'specialty_id'   => $s,
                    'name'  => $faker->sentence(3),
                    'locale' => 'ar',
                ]]);

        }
    }
}
