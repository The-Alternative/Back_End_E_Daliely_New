<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('loc_id')->index();
            $table->unsignedInteger('country_id')->index();
            $table->unsignedInteger('gov_id')->index();
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('street_id')->index();
            $table->unsignedInteger('offer_id')->index();
            $table->unsignedInteger('socialMedia_id')->index();
            $table->unsignedInteger( 'followers_id')->index();
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->boolean('delivery');
            $table->string( 'edalilyPoint');
            $table->string( 'rating');
            $table->string( 'workingHours');
            $table->string( 'logo');
            $table->timestamps();
        });
    }
    /**
     * Rever
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
