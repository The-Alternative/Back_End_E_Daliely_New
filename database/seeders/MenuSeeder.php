<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class MenuSeeder extends Seeder
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
            $s = DB::table('menus')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'restaurant_id' => $faker->numberBetween(1,10),
                'menu_type_id' =>  $faker->numberBetween(1,10),
            ]);
            DB::table('menu_translations')->insert([[
                'title' => $faker->sentence(2),
                'short_description' =>$faker->sentence(5),
                'long_description'  => $faker->sentence(10),
                'menu_id' => $s,
                'locale' => 'en',
            ],
                [
                    'title' => $faker->sentence(2),
                    'short_description' =>$faker->sentence(5),
                    'long_description'  => $faker->sentence(10),
                    'menu_id' => $s,
                    'locale' => 'ar',
                ]]);

        }
    }
}
