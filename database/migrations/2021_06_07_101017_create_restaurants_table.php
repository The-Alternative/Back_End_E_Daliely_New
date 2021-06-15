<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->integer('appointment_id');
            $table->integer('social_media_id');
            $table->integer('active_time_id');
            $table->integer('location_id');
            $table->integer('customer_id');
            $table->integer('type_of_restaurant_id');
<<<<<<< HEAD
            $table->integer('rate_id');
            $table->integer('user_id');
=======
            $table->integer('user_id');
            $table->integer('rate_id');
>>>>>>> 321df2e770c526296aa3ca8f506261aa7ea983f7
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
        Schema::dropIfExists('restaurants');
    }
}
