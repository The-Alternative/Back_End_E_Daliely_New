<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });
        DB::table('appointments')->insert([
            ['customer_id'=>6, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>1, 'is_active'=>1],
            ['customer_id'=>5, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>2, 'is_active'=>1],
            ['customer_id'=>7, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>3, 'is_active'=>1],
            ['customer_id'=>3, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>4, 'is_active'=>1],
            ['customer_id'=>2, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>5, 'is_active'=>1],
            ['customer_id'=>1, 'start_date'=>'2021-05-19' ,'end_date'=>'2021-05-19' ,'start_time'=>'18:56:17' ,'end_time'=>'19:56:17' , 'is_approved'=>1, 'doctor_id'=>6, 'is_active'=>1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
