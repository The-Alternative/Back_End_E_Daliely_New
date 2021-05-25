<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $s=DB::table('products')->insertGetId([
//            'slug' =>Str::random(10),
//            'image' =>Str::random(10),
//            'barcode' =>Str::random(10),
//            'is_active' =>1,
//            'is_appear' =>1,
//            'custom_feild_id' =>1,
//            'rating_id' =>1,
//            'brand_id' =>1,
//            'offer_id' =>1,
//            'category_id'=>1
//        ]);
//        DB::table('product_translations')->insert([
//            'name' =>Str::random(10),
//            'short_des' =>Str::random(10),
//            'locale' =>Str::random(10),
//            'long_des' =>Str::random(10),
//            'meta' =>Str::random(10),
//            'product_id' => $s
//        ]);

    }
}
