<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
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
            $s = DB::table('sections')->insertGetId([
                'slug' => $faker->sentence(1),
                'image' => $faker->sentence(10),
                'is_active' => 1
=======
        for ($i = 1; $i <= 10; $i++) {
            $s = DB::table('sections')->insertGetId([
                'slug' => $faker->sentence(1),
                'image' => $faker->sentence(10),
                'is_active' => $faker->boolean,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ]);
            DB::table('section_translations')->insert([[
                'name' => $faker->sentence(2),
                'description' => $faker->sentence(10),
                'local' => 'en',
                'section_id' => $s
            ],
                [
                    'name' => $faker->sentence(2),
                    'description' => $faker->sentence(10),
<<<<<<< HEAD
                    'local' => 'en',
=======
                    'local' => 'ar',
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                    'section_id' => $s
                ]]);

        }
    }
}
