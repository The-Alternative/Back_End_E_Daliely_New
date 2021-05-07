<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_times', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_active');
            $table->boolean('is_approved');

            $table->timestamps();
        });

        DB::table('active_times')->insert([
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],
            ['start_time'=>'18:56:17' ,'end_time'=>'18:56:17' , 'is_approved'=>1,'is_active'=>1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_times');
    }
}
