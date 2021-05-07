<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorMedicalDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_Medical_Device', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->integer('medical_device_id')->unsigned();
            $table->timestamps();
        });
        DB::table('doctor_Medical_Device')->insert([
            ['medical_device_id' =>1,'doctor_id' => 1],
            ['medical_device_id' =>2,'doctor_id' => 2],
            ['medical_device_id' =>3,'doctor_id' => 3],
            ['medical_device_id' =>4,'doctor_id' => 4],
            ['medical_device_id' =>4,'doctor_id' => 5],
            ['medical_device_id' =>4,'doctor_id' => 6],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctorMedicalDevice');
    }
}
