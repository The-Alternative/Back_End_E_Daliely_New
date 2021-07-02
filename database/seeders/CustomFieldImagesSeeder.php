<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomFieldImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($customFiled=1;$customFiled<5;$customFiled++){
            for($image=1;$image<5;$image++) {
                DB::table('custom_field_images')->insert(
                    [
                        'custom_field_id'=>$customFiled,
                        'image'=>$faker->sentence(1),
                        'is_cover'=>0,
                    ]
                );
            }
        }
    }
}
