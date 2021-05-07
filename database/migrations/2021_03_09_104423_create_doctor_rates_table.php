<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->integer('rate');
            $table->timestamps();
        });
        DB::table('doctor_rates')->insert([
                        ['doctor_id'=>1,'rate'=>4],
                        ['doctor_id'=>2,'rate'=>3],
                        ['doctor_id'=>3,'rate'=>6],
                        ['doctor_id'=>4,'rate'=>1],
                        ['doctor_id'=>5,'rate'=>2],
                        ['doctor_id'=>6,'rate'=>5]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_rates');
    }
}
