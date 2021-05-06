<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMedicalDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_devices', function (Blueprint $table) {
            $table->id();
            $table->integer('hospital_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });

        DB::table('medical_devices')->insert([
            ['hospital_id' =>1,'doctor_id' => 1, 'is_approved' => 1, 'is_active' => 1],
            ['hospital_id' =>2,'doctor_id' => 2, 'is_approved' => 1, 'is_active' => 1],
            ['hospital_id' =>3,'doctor_id' => 3, 'is_approved' => 1, 'is_active' => 1],
            ['hospital_id' =>4,'doctor_id' => 4, 'is_approved' => 1, 'is_active' => 1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_devices');
    }
}
