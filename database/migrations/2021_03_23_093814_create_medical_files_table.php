<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CreateMedicalFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_files', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('customer_id');
            $table->integer('file_number');
            $table->date('file_date');
            $table->date('review_date');
            $table->string('PDF');
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });
        DB::table('medical_files')->insert([
            ['customer_id'=>6, 'file_number'=>123,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>1, 'is_active'=>1],
            ['customer_id'=>5, 'file_number'=>23 ,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>2, 'is_active'=>1],
            ['customer_id'=>7, 'file_number'=>123,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>3, 'is_active'=>1],
            ['customer_id'=>3, 'file_number'=>123,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>4, 'is_active'=>1],
            ['customer_id'=>2, 'file_number'=>123,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>5, 'is_active'=>1],
            ['customer_id'=>1, 'file_number'=>123,'file_date'=>'2021-05-19' ,'review_date'=>'2021-05-19' ,'PDF'=>'aaaa', 'is_approved'=>1, 'doctor_id'=>6, 'is_active'=>1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_files');
    }
}
