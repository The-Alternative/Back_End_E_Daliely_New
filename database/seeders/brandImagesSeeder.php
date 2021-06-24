<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class brandImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($brand=1;$brand<5;$brand++){
            for($image=1;$image<5;$image++) {
                DB::table('brand_images')->insert(
                    [
                        'brand_id'=>$brand,
                        'image'=>$faker->sentence(1),
                        'is_cover'=>0,
                    ]
                );
            }
        }
    }
}
