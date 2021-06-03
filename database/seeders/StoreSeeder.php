<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
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
            $s = DB::table('stores')->insertGetId([
                'loc_id' => 1,
                'country_id' => 1,
                'gov_id' => 1,
                'city_id'=> 1,
                'offer_id'=>1,
                'street_id'=> 1,
                'followers_id'=>1,
                'is_active'=>1,
                'is_approved'=>1,
                'delivery'=>1,
                'socialMedia_id'=>1,
                'edalilyPoint'=>$faker->sentence(1),
                'rating'=>$faker->sentence(1),
                'workingHours'=>$faker->sentence(1),
                'logo'=>$faker->sentence(1),
            ]);
            DB::table('store_translations')->insert([[
                'title' => $faker->sentence(5),
                'local' => 'en',
                'store_id' => $s
            ],
                [
                    'title' => $faker->sentence(5),
                    'local' => 'ar',
                    'store_id' => $s
                ]]);

        }
    }
}
