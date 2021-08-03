<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_store', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('store_id');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->integer('price');
            $table->integer('new_price');
            $table->boolean('is_active');
            $table->boolean('is_approved');
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
        Schema::dropIfExists('post_store');
    }
}
