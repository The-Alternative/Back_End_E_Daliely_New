<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        for($section_id=1;$section_id<12;$section_id++){
            for($product_id=1;$product_id<12;$product_id++) {
=======
        for($section_id=1;$section_id<5;$section_id++){
            for($product_id=1;$product_id<3;$product_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                DB::table('products_sections')->insert(
                    [
                        'section_id'=>$section_id,
                        'product_id'=>$product_id
                    ]
                );
            }
        }
    }
}
