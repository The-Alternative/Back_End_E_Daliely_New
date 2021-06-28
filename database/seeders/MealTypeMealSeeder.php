<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTypeMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($meal_id = 1; $meal_id < 12; $meal_id++) {
            for ($meal_type_id = 1; $meal_type_id < 12; $meal_type_id++) {
                DB::table('meal_type_meal')->insert(
                    [
                        'meal_type_id' => $meal_type_id,
                        'meal_id' => $meal_id
                    ]
                );
            }
        }
    }
}
