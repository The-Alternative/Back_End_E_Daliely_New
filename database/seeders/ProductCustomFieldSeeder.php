<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        for($product_id=1;$product_id<12;$product_id++){
            for($customfield_id=1;$customfield_id<12;$customfield_id++) {
                DB::table('products_custom_field_value')->insert(
                    [
                        'custom_field_value_id'=>$customfield_id,
=======
        for($product_id=1;$product_id<5;$product_id++){
            for($customfield_id=1;$customfield_id<3;$customfield_id++) {
                DB::table('products_custom_fields')->insert(
                    [
                        'customfield_id'=>$customfield_id,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                        'product_id'=>$product_id
                    ]);
            }
        }

    }
}
