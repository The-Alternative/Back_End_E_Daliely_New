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
