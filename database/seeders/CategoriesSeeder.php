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
        for ($i = 1; $i <= 200; $i++) {
            $s = DB::table('categories')->insertGetId([
                'slug' => $faker->sentence(1),
                'is_active' => 1,
                'image' => $faker->sentence(10),
                'parent_id' =>1,
                'lang_id' => 1,
                'section_id' => 1
            ]);
            DB::table('category_translations')->insert([[
                'name' => $faker->sentence(5),
                'local' => 'en',
                'language_id' =>1,
                'category_id' => $s
            ],
                [
                    'name' => $faker->sentence(5),
                    'local' => 'ar',
                    'language_id' =>1,
                    'category_id' => $s
                ]]);

        }
    }

}
