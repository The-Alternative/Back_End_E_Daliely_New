<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id')->unsigned();
            $table->integer('phone_number');
            $table->integer('doctor_id')->unsigned();
            $table->integer('active_time_id')->unsigned();
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });
        DB::table('clinics')->insert([
            ['phone_number' =>1234560, 'location_id' => 1,'active_time_id' => 1,'doctor_id' => 1, 'is_approved' => 1, 'is_active' => 1],
            ['phone_number' =>1234560, 'location_id' => 2,'active_time_id' => 2,'doctor_id' => 2, 'is_approved' => 1, 'is_active' => 1],
            ['phone_number' =>1234560, 'location_id' => 3,'active_time_id' => 3,'doctor_id' => 3, 'is_approved' => 1, 'is_active' => 1],
            ['phone_number' =>1234560, 'location_id' => 4,'active_time_id' => 4,'doctor_id' => 4, 'is_approved' => 1, 'is_active' => 1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
