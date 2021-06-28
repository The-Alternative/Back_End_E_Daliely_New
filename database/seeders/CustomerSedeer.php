<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $faker=Faker::create();
        for ($i = 0; $i <= 5; $i++) {
            $s = DB::table('customers')->insertGetId([
                'is_active' => $faker->boolean,
                'is_approved' =>$faker->boolean,
                'social_media_id' => $faker->unique()->numberBetween(1,10)
            ]);
            DB::table('customer_translations')->insert([[
                'customer_id' => $s,
                'first_name' => $faker->sentence(2),
                'last_name'  => $faker->sentence(2),
                'address'  => $faker->sentence(5),
                'locale' => 'en',
            ],
                [
=======
        $faker = Faker::create();
            for ($i = 0; $i <= 5; $i++) {
                $s = DB::table('customers')->insertGetId([
                    'is_active' => $faker->boolean,
                    'is_approved' => $faker->boolean,
                    'social_media_id' => $faker->numberBetween(1, 200)
                ]);
                DB::table('customer_translations')->insert([[
>>>>>>> a9264f83549a1973c725d0e31b50e2600d61d728
                    'customer_id' => $s,
                    'first_name' => $faker->sentence(2),
                    'last_name' => $faker->sentence(2),
                    'address' => $faker->sentence(5),
                    'locale' => 'en',
                ],
                    [
                        'customer_id' => $s,
                        'first_name' => $faker->sentence(2),
                        'last_name' => $faker->sentence(2),
                        'address' => $faker->sentence(5),
                        'locale' => 'ar',
                    ]]);

            }
        }
}
