<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('day_name');
            $table->dateTime('timestamps');
            $table->string('holiday_name');
            $table->string('holiday_note');
            $table->timestamps();
        });
        DB::table('calendars')->insert([

            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],
            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],
            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],
            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],
            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],
            ['day_name'=>'saturday' ,'timestamps'=>'2021-05-18 19:30:27' ,'holiday_name'=>'friday' ,'holiday_note'=>'Hello World'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
