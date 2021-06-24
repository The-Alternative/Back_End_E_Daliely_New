<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        for($store_id=1;$store_id<12;$store_id++){
            for($brand_id=1;$brand_id<12;$brand_id++) {
=======
        for($store_id=1;$store_id<5;$store_id++){
            for($brand_id=1;$brand_id<3;$brand_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                DB::table('store_brand')->insert(
                    [
                        'brand_id'=>$brand_id,
                        'store_id'=>$store_id
                    ]
                );
            }
        }
    }
}
