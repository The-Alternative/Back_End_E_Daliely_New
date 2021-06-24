<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($category=1;$category<5;$category++){
            for($image=1;$image<5;$image++) {
                DB::table('category_images')->insert(
                    [
                        'category_id'=>$category,
                        'image'=>$faker->sentence(1),
                        'is_cover'=>0,
                    ]
                );
            }
        }
    }
}
