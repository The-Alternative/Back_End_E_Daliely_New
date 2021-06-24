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
<<<<<<< HEAD
//       $faker =Faker::create();
//       for ($i=1;$i<=100;$i++){
//           DB::table('customer_doctor')->insert([
//               'is_active' => 1,
//               'is_approved' => 1,
//               'note'=>$faker->sentence(10),
//               'blood_type' => $faker->bloodType(),
//               'social_status' => $faker->sentence(1),
//               'gender' =>$faker->sentence(1),
//               'age' =>$faker->numberBetween(1,90),
//               'medical_file_id' => $faker->numberBetween(1,200),
//               'customer_id' => $faker->numberBetween(1,200),
//               'doctor_id' => $faker->numberBetween(1,200)
//           ]);
//
//       }
=======
       $faker =Faker::create();
       for ($i=1;$i<=5;$i++){
           DB::table('customer_doctor')->insert([
               'is_active' => $faker->boolean,
               'is_approved' => $faker->boolean,
               'note'=>$faker->sentence(10),
               'blood_type' => $faker->bloodType(),
               'social_status' => $faker->sentence(1),
               'gender' =>$faker->sentence(1),
               'age' =>$faker->numberBetween(1,90),
               'medical_file_id' => $faker->numberBetween(1,200),
               'customer_id' => $faker->numberBetween(1,200),
               'doctor_id' => $faker->numberBetween(1,200)
           ]);

       }
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
    }
}
