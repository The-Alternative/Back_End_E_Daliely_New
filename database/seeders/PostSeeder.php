<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('posts')->insertGetId([
                'image' => $faker->sentence(5),
                'is_active' => $faker->boolean,
                'is_approved' => $faker->boolean,
            ]);
            DB::table('post_translations')->insert([[
                'name' => $faker->sentence(2),
                'short_description' => $faker->sentence(5),
                'long_description' => $faker->sentence(10),
                'locale' => 'en',
                'post_id' => $s,
            ],
                [
                    'name' => $faker->sentence(2),
                    'short_description' => $faker->sentence(5),
                    'long_description' => $faker->sentence(10),
                    'locale' => 'ar',
                    'post_id' => $s,
                ]]);

        }
    }

}
