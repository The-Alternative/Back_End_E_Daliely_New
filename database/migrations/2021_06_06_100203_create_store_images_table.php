<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id');
<<<<<<< HEAD
            $table->string('image');
=======
            $table->string('name');
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            $table->boolean('is_cover');
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
        Schema::dropIfExists('store_images');
    }
}
