<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        for($category_id=1;$category_id<12;$category_id++){
            for($product_id=1;$product_id<12;$product_id++) {
=======
        for($category_id=1;$category_id<5;$category_id++){
            for($product_id=1;$product_id<3;$product_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                DB::table('products_categories')->insert(
                     [
                        'category_id'=>$category_id,
                        'product_id'=>$product_id
                    ]);
            }
        }
    }
}
