<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Doctor_Customer', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('customer_id');
            $table->integer('medical_file_id');
            $table->integer('age');
            $table->string('gender');
            $table->string('social_status');
            $table->string('blood_type');
            $table->string('note');
            $table->boolean('is_active');
            $table->boolean('is_approved');
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
        Schema::dropIfExists('Doctor_Customer');
    }
}
