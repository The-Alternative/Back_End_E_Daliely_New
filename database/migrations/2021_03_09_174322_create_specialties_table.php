<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('graduation_year');
            $table->boolean('is_active');
            $table->timestamps();
        });
        DB::table('specialties')->insert([
            ['graduation_year'=>'1998', 'is_active'=>1],
            ['graduation_year'=>'1994', 'is_active'=>1],
            ['graduation_year'=>'1996', 'is_active'=>1],
            ['graduation_year'=>'1912', 'is_active'=>1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
