<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomFieldSeeder extends Seeder
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
            $s = DB::table('custom_fields')->insertGetId([
                'is_active' => 1,
=======
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('custom_fields')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509

            ]);
            DB::table('custom__fields__translations')->insert([[
                'custom_field_id' => $s,
                'description' =>$faker->sentence(10),
                'local' => 'en',
                'name' => $faker->sentence(2),
<<<<<<< HEAD
=======


>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ],
                [
                    'custom_field_id' => $s,
                    'description' =>$faker->sentence(10),
                    'local' => 'ar',
                    'name' => $faker->sentence(2),
                ]]);

        }
    }
}
