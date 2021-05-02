<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StoresProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_products', function (Blueprint $table) {
            $table->id();


           // $table->unsignedInteger('store_id');
          //  $table->unsignedInteger('product_id');
//            $table->unsignedInteger('price');
//            $table->unsignedInteger('quantity');

            $table->unsignedInteger('store_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->boolean('is_active');
            $table->boolean('is_appear');
            $table->timestamps();
        });
        DB::table('stores_products')->insert([
            ['product_id'=>1,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>250,'quantity'=>300],
            ['product_id'=>2,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>300,'quantity'=>300],
            ['product_id'=>4,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>350,'quantity'=>300],
            ['product_id'=>5,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>400,'quantity'=>300],
            ['product_id'=>6,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>450,'quantity'=>300],
            ['product_id'=>7,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>500,'quantity'=>300],
            ['product_id'=>8,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>550,'quantity'=>300],
            ['product_id'=>9,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>600,'quantity'=>300],
            ['product_id'=>10,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>650,'quantity'=>300],
            ['product_id'=>11,'store_id'=>1,'is_active'=>1,'is_appear'=>1,'price'=>700,'quantity'=>300]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
