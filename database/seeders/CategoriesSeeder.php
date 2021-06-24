<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
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
            $s = DB::table('categories')->insertGetId([
                'slug' => $faker->sentence(1),
                'is_active' => 1,
                'parent_id' =>1,
                'lang_id' => 1,
                'section_id' => 1
=======
        for ($i = 1; $i <= 5; $i++) {
            $s = DB::table('categories')->insertGetId([
                'slug' => $faker->sentence(1),
                'is_active' => $faker->boolean,
                'image' => $faker->sentence(3),
                'parent_id' => $faker->numberBetween(1,200),
                'lang_id' =>  $faker->numberBetween(1,200),
                'section_id' =>  $faker->numberBetween(1,200)
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            ]);
            DB::table('category_translations')->insert([[
                'name' => $faker->sentence(5),
                'local' => 'en',
<<<<<<< HEAD
                'language_id' =>1,
=======
                'language_id' => $faker->numberBetween(1,5),
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                'category_id' => $s
            ],
                [
                    'name' => $faker->sentence(5),
                    'local' => 'ar',
<<<<<<< HEAD
                    'language_id' =>1,
=======
                    'language_id' => $faker->numberBetween(1,5),
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                    'category_id' => $s
                ]]);

        }
    }

}
