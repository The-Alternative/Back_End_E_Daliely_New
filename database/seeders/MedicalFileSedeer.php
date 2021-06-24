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
<<<<<<< HEAD
        for ($i = 0; $i <= 200; $i++) {
            DB::table('medical_files')->insert([
                'is_active' => 1,
                'is_approved' => 1,
=======
        for ($i = 0; $i <= 5; $i++) {
            DB::table('medical_files')->insert([
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                'pdf'=>$faker->sentence(3),
                'file_number' => $faker->numberBetween(1,200),
                'file_date' => $faker->date('2021-8-20'),
                'review_date' =>$faker->date('2021-9-20'),
<<<<<<< HEAD
                'doctor_id' => 1,
                'customer_id' => 1
=======
                'doctor_id' => $faker->numberBetween(1, 200),
                'customer_id' =>$faker->numberBetween(1, 200),
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509

            ]);
        }
    }
}
