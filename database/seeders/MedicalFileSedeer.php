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
        for ($i = 0; $i <= 200; $i++) {
            DB::table('medical_files')->insert([
                'is_active' => 1,
                'is_approved' => 1,
                'pdf'=>$faker->sentence(3),
                'file_number' => $faker->numberBetween(1,200),
                'file_date' => $faker->date('2021-8-20'),
                'review_date' =>$faker->date('2021-9-20'),
                'doctor_id' => 1,
                'customer_id' => 1

            ]);
        }
    }
}
