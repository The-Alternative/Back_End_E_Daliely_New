<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('menu_types')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'menu_id' =>  $faker->numberBetween(1,10),

            ]);
            DB::table('menu_type_translations')->insert([[
                'title' => $faker->sentence(2),
                'short_description' =>$faker->sentence(5),
                'long_description' =>$faker->sentence(10),
                'menu_type_id' => $s,
                'locale' => 'en',
            ],
                [
                    'title' => $faker->sentence(2),
                    'short_description' =>$faker->sentence(5),
                    'long_description' =>$faker->sentence(10),
                    'menu_type_id' => $s,
                    'locale' => 'ar',
                ]]);
        }
    }
}
