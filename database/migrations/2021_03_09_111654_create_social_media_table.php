<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->integer('phone_number');
            $table->integer('whatsapp_number');
            $table->string('facebook_account');
            $table->string('instagram_account');
            $table->integer('telegram_number');
            $table->string('email');
            $table->integer('doctor_id')->unsigned();
            $table->boolean('is_active');

            $table->timestamps();
        });
        DB::table('social_media')->insert([
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>1, 'is_active'=>1],
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>2, 'is_active'=>1],
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>3, 'is_active'=>1],
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>4, 'is_active'=>1],
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>5, 'is_active'=>1],
            ['phone_number'=>123456,    'whatsapp_number'=>1236987,'facebook_account'=>'https://facebook.com','instagram_account'=>'instagram', 'telegram_number'=>5698412, 'email'=>'asd@gmail.com', 'doctor_id'=>6, 'is_active'=>1],
        ]);
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
