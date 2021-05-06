<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('medical_center');
            $table->boolean('private_hospital');
            $table->boolean('general_hospital');
            $table->integer('location_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->boolean('is_active');
            $table->boolean('is_approved');

            $table->timestamps();
        });

        DB::table('hospitals')->insert([
            ['name' => 'alsalam', 'medical_center' => 'one', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 1,'doctor_id' => 1, 'is_approved' => 1, 'is_active' => 1],
            ['name' => 'al3naia', 'medical_center' => 'tow', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 2,'doctor_id' => 2, 'is_approved' => 1, 'is_active' => 1],
            ['name' => 'watan',   'medical_center' => 'one', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 3,'doctor_id' => 3, 'is_approved' => 1, 'is_active' => 1],
            ['name' => 'salam',   'medical_center' => 'tow', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 4,'doctor_id' => 4, 'is_approved' => 1, 'is_active' => 1],
            ['name' => 'hope',    'medical_center' => 'one', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 5,'doctor_id' => 5, 'is_approved' => 1, 'is_active' => 1],
            ['name' => 'asd',     'medical_center' => 'tow', 'private_hospital' => 1, 'general_hospital' => 0, 'location_id' => 6,'doctor_id' => 6, 'is_approved' => 1, 'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
}
