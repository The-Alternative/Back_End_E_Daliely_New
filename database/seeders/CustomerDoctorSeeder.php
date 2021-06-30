<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CustomerDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker =Faker::create();
       for ($i=1;$i<=5;$i++){
           DB::table('customer_doctor')->insert([
               'is_active' => $faker->boolean,
               'is_approved' => $faker->boolean,
               'note'=>$faker->sentence(10),
               'blood_type' => $faker->bloodType(),
               'social_status' => $faker->sentence(1),
               'gender' =>$faker->sentence(1),
               'age' =>$faker->numberBetween(1,50),
               'medical_file_id' => $faker->numberBetween(1,10),
               'customer_id' => $faker->numberBetween(1,10),
               'doctor_id' => $faker->numberBetween(1,10)
           ]);

       }
    }
}
