<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
        });
        DB::table('products_categories')->insert([
            ['product_id'=>1,'category_id'=>1],
            ['product_id'=>2,'category_id'=>1],
            ['product_id'=>4,'category_id'=>1],
            ['product_id'=>5,'category_id'=>1],
            ['product_id'=>6,'category_id'=>1],
            ['product_id'=>7,'category_id'=>1],
            ['product_id'=>8,'category_id'=>1],
            ['product_id'=>9,'category_id'=>1],
            ['product_id'=>10,'category_id'=>1],
            ['product_id'=>11,'category_id'=>1],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_categories');
    }
}
