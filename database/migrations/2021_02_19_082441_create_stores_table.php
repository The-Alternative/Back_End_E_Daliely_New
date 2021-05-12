<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        DB::table('stores')->insert([
            ['loc_id' => 1,'country_id' => 1,'gov_id' => 1,'city_id' => 1,'street_id' => 1,'offer_id' => 1,'socialMedia_id' => 1,'followers_id' => 1,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
            ['loc_id' => 2,'country_id' => 2,'gov_id' => 2,'city_id' => 2,'street_id' => 2,'offer_id' => 2,'socialMedia_id' => 2,'followers_id' => 2,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
            ['loc_id' => 3,'country_id' => 3,'gov_id' => 3,'city_id' => 3,'street_id' => 3,'offer_id' => 3,'socialMedia_id' => 3,'followers_id' => 3,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
            ['loc_id' => 4,'country_id' => 4,'gov_id' => 4,'city_id' => 4,'street_id' => 4,'offer_id' => 4,'socialMedia_id' => 4,'followers_id' => 4,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
            ['loc_id' => 5,'country_id' => 5,'gov_id' => 5,'city_id' => 5,'street_id' => 5,'offer_id' => 5,'socialMedia_id' => 5,'followers_id' => 5,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
            ['loc_id' => 6,'country_id' => 6,'gov_id' => 6,'city_id' => 6,'street_id' => 6,'offer_id' => 6,'socialMedia_id' => 6,'followers_id' => 6,'is_active' => 1, 'is_approved' => 1, 'delivery' => 1, 'edalilyPoint' =>'Developer', 'rating' =>'Developer','workingHours' =>'Developer','logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSy6iZq7N0bOew1ttlwpQRgf-SmI4MHbWZU3Q&usqp=CAU'],
        ]);
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
