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
        for ($i = 1; $i <= 200; $i++) {
            $s = DB::table('brands')->insertGetId([
                'is_active'=>1,
                'image'=>$faker->sentence(10),
                'slug'=>$faker->sentence(10),
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
