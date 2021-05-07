<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_Specialty', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->integer('specialties_id')->unsigned();
            $table->timestamps();
        });
        DB::table('doctor_Specialty')->insert([
            ['doctor_id'=>1, 'specialties_id'=>2],
            ['doctor_id'=>2, 'specialties_id'=>6],
            ['doctor_id'=>3, 'specialties_id'=>5],
            ['doctor_id'=>4, 'specialties_id'=>1],
            ['doctor_id'=>5, 'specialties_id'=>3],
            ['doctor_id'=>6, 'specialties_id'=>4],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctorSpecialty');
    }
}
