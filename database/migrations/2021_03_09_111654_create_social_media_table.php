<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('phone_number');
            $table->bigInteger('whatsapp_number');
            $table->string('facebook_account');
            $table->string( 'instagram_account');
            $table->bigInteger('telegram_number');
            $table->string( 'email');
            $table->integer('doctor_id')->unsigned();
            $table->boolean('is_active');

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
        Schema::dropIfExists('social_media');
    }
}
