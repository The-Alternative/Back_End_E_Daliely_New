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
            $table->integer('medical_file_id');
            $table->integer('age');
            $table->string( 'gender');
            $table->string( 'social_status');
            $table->string( 'blood_type');
            $table->string( 'note');
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });
//        DB::table('customer_doctor')->insert([
//            ['doctor_id'=>1, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ],
//            ['doctor_id'=>2, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ],
//            ['doctor_id'=>3, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ],
//            ['doctor_id'=>4, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ],
//            ['doctor_id'=>5, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ],
//            ['doctor_id'=>6, 'customer_id'=>1, 'medical_file_id'=>1, 'age'=>45, 'gender'=>'male', 'social_status'=>'married', 'blood_type'=>'A-', 'note'=>'dead', 'is_active'=>1, 'is_approved'=>1 ]
//
//        ]);
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
