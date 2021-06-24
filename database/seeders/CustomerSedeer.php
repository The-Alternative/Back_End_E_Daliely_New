<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSedeer extends Seeder
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
            $s = DB::table('customers')->insertGetId([
                'is_active' => 1,
                'is_approved' =>1,
                'social_media_id' => 1
=======
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('customers')->insertGetId([
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'social_media_id' => $faker->numberBetween(1,200)
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ]);
            DB::table('customer_translations')->insert([[
                'customer_id' => $s,
                'first_name' => $faker->sentence(2),
                'last_name'  => $faker->sentence(2),
                'address'  => $faker->sentence(5),
                'locale' => 'en',
            ],
                [
                    'customer_id' => $s,
                    'first_name' => $faker->sentence(2),
                    'last_name'  => $faker->sentence(2),
                    'address'  => $faker->sentence(5),
                    'locale' => 'ar',
                ]]);

        }
    }
}
