<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

<<<<<<< HEAD
        for ($sections_id = 1; $sections_id < 12; $sections_id++) {
            for ($brands_id = 1; $brands_id < 12; $brands_id++) {
=======
        for ($sections_id = 1; $sections_id < 6; $sections_id++) {
            for ($brands_id = 1; $brands_id < 3; $brands_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                DB::table('brand_sections')->insert(
                    [
                        'brands_id' => $brands_id,
                        'sections_id' => $sections_id
                    ]);

            }
        }
    }
}
