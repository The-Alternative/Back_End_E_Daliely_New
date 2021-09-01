<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_doctor', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('customer_id');
            $table->integer('age');
            $table->string( 'gender');
            $table->string( 'social_status');
            $table->string( 'blood_type');
            $table->string( 'note');
            $table->integer('medical_file_number');
            $table->date('medical_file_date');
            $table->date('review_date');
            $table->string('PDF');
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
        Schema::dropIfExists('customer_doctor');
    }
}
