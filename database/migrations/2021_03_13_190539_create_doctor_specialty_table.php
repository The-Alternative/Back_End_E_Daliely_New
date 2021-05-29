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
        for($doctor_id=1;$doctor_id<12;$doctor_id++) {
            for ($specialties_id = 1; $specialties_id < 12; $specialties_id++) {
                DB::table('doctor_Specialty')->insert(
                     [
                        'doctor_id' => $doctor_id,
                        'specialties_id' => $specialties_id
                    ]
                );
            }
        }

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
