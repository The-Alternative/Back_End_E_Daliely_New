<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->integer('social_media_id')->unsigned();
            $table->integer('specialty_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
            $table->integer('clinic_id')->unsigned();
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });

        DB::table('doctors')->insert([
            ['image' => 'https://img.lovepik.com/photo/50015/8348.jpg_wh860.jpg', 'social_media_id' => 1, 'specialty_id' => 1, 'hospital_id' => 1, 'clinic_id' => 1, 'is_approved' => 1, 'is_active' => 1],
            ['image' => 'https://i.suar.me/LW5aE/l',                              'social_media_id' => 2, 'specialty_id' => 2, 'hospital_id' => 2, 'clinic_id' => 2, 'is_approved' => 1, 'is_active' => 1],
            ['image' => 'https://suar.me/Nwv3V',                                  'social_media_id' => 3, 'specialty_id' => 3, 'hospital_id' => 3, 'clinic_id' => 3, 'is_approved' => 1, 'is_active' => 1],
            ['image' => 'https://i.suar.me/52029/l',                              'social_media_id' => 4, 'specialty_id' => 4, 'hospital_id' => 4, 'clinic_id' => 4, 'is_approved' => 1, 'is_active' => 1],
            ['image' => 'https://i.suar.me/rN0NE/l',                              'social_media_id' => 5, 'specialty_id' => 5, 'hospital_id' => 5, 'clinic_id' => 5, 'is_approved' => 1, 'is_active' => 1],
            ['image' => 'https://i.suar.me/moJ8j/l',                              'social_media_id' => 6, 'specialty_id' => 6, 'hospital_id' => 6, 'clinic_id' => 6, 'is_approved' => 1, 'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
