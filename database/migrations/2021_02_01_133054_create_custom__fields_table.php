<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->timestamps();
        });
        DB::table('custom_fields')->insert([
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
            [ 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU','is_active'=>'1'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom__fields');
    }
}
