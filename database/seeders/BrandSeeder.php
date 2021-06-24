<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
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
        for ($i = 1; $i <= 200; $i++) {
            $s = DB::table('brands')->insertGetId([
                'is_active'=>1,
                'slug'=>$faker->sentence(10),
=======
        for ($i = 1; $i <= 5; $i++) {
            $s = DB::table('brands')->insertGetId([
                'is_active'=>$faker->boolean,
                'image'=>$faker->sentence(3),
                'slug'=>$faker->sentence(3),
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ]);
            DB::table('brand_translation')->insert([[
                'brand_id' => $s,
                'description' => $faker->sentence(10),
                'locale' => 'en',
                'name' => $faker->sentence(5),


            ],
                ['brand_id' => $s,
                    'description' => $faker->sentence(10),
                    'locale' => 'en',
                    'name' => $faker->sentence(5),
                ]]);

        }
    }
}
