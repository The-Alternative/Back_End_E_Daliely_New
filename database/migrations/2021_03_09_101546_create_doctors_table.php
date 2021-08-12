<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
=======
            $table->integer('social_media_id')->unsigned();
>>>>>>> 62a02217c662fb014b0341871acad38f3a079865
            $table->integer('clinic_id')->unsigned();
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
        Schema::dropIfExists('doctors');
    }
}
