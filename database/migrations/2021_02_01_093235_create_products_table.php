<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('image');
            $table->string('barcode');
            $table->unsignedInteger('brand_id')->index();
            $table->unsignedInteger('rating_id')->index();
            $table->unsignedInteger('offer_id')->index();
            $table->boolean('is_active');
            $table->boolean('is_appear');
            $table->timestamps();
        });

        DB::table('products')->insert([
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
            ['slug' => 'Admin', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','barcode'=>'2121','brand_id'=>1,'rating_id'=>'1','offer_id'=>'1','is_active'=>'1','is_appear'=>'1'],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
