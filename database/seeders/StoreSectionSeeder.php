<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSectionSeeder extends Seeder
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
            for($store_id=1;$store_id<12;$store_id++) {
=======
        for($section_id=1;$section_id<5;$section_id++){
            for($store_id=1;$store_id<3;$store_id++) {
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
                DB::table('stores_sections')->insert(
                     [
                        'section_id'=>$section_id,
                        'store_id'=>$store_id
                    ]
                );
            }
        }
    }
}
