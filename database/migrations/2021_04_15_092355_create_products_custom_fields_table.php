<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('customfield_id');
            $table->timestamps();
        });
        DB::table('products_custom_fields')->insert([
            ['customfield_id'=>1,'product_id'=>1],
            ['customfield_id'=>2,'product_id'=>1],
            ['customfield_id'=>4,'product_id'=>1],
            ['customfield_id'=>5,'product_id'=>1],
            ['customfield_id'=>6,'product_id'=>1],
            ['customfield_id'=>7,'product_id'=>1],
            ['customfield_id'=>8,'product_id'=>1],
            ['customfield_id'=>9,'product_id'=>1],
            ['customfield_id'=>10,'product_id'=>1],
            ['customfield_id'=>11,'product_id'=>1],
                ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_custom_fields');
    }
}
