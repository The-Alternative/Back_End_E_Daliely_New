<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_hospital', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->integer('hospital_id')->unsigned();
            $table->timestamps();
        });
        DB::table('doctor_hospital')->insert([
            ['doctor_id'=>1, 'hospital_id' => 1],
            ['doctor_id'=>2, 'hospital_id' => 2],
            ['doctor_id'=>3, 'hospital_id' => 3],
            ['doctor_id'=>4, 'hospital_id' => 4],
            ['doctor_id'=>5, 'hospital_id' => 5],
            ['doctor_id'=>6, 'hospital_id' => 6]

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_hospital');
    }
}
