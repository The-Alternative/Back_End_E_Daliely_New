<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalFileSedeer extends Seeder
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
            DB::table('medical_files')->insert([

                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
                'pdf'=>$faker->sentence(3),
                'file_number' => $faker->numberBetween(1,10),
                'file_date' => $faker->date('2021-8-20'),
                'review_date' =>$faker->date('2021-9-20'),
                'doctor_id' => $faker->numberBetween(1, 10),
                'customer_id' =>$faker->numberBetween(1, 10),]);

            }
        }
}
