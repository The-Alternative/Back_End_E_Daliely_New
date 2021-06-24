<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActiveTimeSedeer extends Seeder
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
            DB::table('active_times')->insert([
                'is_active' => 1,
                'is_approved' => 1,
=======
        for ($i = 0; $i <= 5; $i++) {
            DB::table('active_times')->insert([
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                'start_time'=>$faker->time('21:12:31'),
                'end_time' => $faker->time('21:12:31')
            ]);
        }
    }
}
