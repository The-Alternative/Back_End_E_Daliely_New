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
            $table->unsignedInteger('store_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity')->default(300);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_appear')->default(1);
            $table->timestamps();
        });
        for($store_id=1;$store_id<12;$store_id++){
            for($product_id=1;$product_id<22;$product_id++) {
                DB::table('stores_products')->insert(
                    $arr = [
                    'product_id'=>$product_id,
                    'store_id'=>$store_id,
                    'price'=>rand(100,1000)
                ]
            );
            }
        }
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
