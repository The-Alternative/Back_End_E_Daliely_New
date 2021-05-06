<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_translation', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->string('locale');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('doctor_translation')->insert([
            ['doctor_id' => 1, 'locale' => 'en', 'first_name' => 'asmar',  'last_name' => 'asmar', 'description' => 'asdasdasdas'],
            ['doctor_id' => 1, 'locale' => 'fr', 'first_name' => 'asmar',  'last_name' => 'asmar', 'description' => 'asdasdasdas'],
            ['doctor_id' => 1, 'locale' => 'ar', 'first_name' => 'اسمر',   'last_name' => 'اسمر', 'description' => 'asdasdasdas'],

            ['doctor_id' => 2, 'locale' => 'en', 'first_name' => 'ahmad', 'last_name' => 'ahmad', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 2, 'locale' => 'fr', 'first_name' => 'ahmad', 'last_name' => 'ahmad', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 2, 'locale' => 'ar', 'first_name' => 'احمد',  'last_name' => 'احمد', 'description' => 'asdasdasdasd'],

            ['doctor_id' => 3, 'locale' => 'en', 'first_name' => 'hammam', 'last_name' => 'hammam', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 3, 'locale' => 'fr', 'first_name' => 'hammam', 'last_name' => 'hammam', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 3, 'locale' => 'ar', 'first_name' => 'همام',   'last_name' => 'همام', 'description' => 'asdasdasdasd'],

            ['doctor_id' => 4, 'locale' => 'en', 'first_name' => 'fahed', 'last_name' => 'fahed', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 4, 'locale' => 'fr', 'first_name' => 'fahed', 'last_name' => 'fahed', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 4, 'locale' => 'ar', 'first_name' => 'فهد',   'last_name' => 'فهد', 'description' => 'asdasdasdasd'],

            ['doctor_id' => 5, 'locale' => 'en', 'first_name' => 'ahlam', 'last_name' => 'ahlam', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 5, 'locale' => 'fr', 'first_name' => 'ahlam', 'last_name' => 'ahlam', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 5, 'locale' => 'ar', 'first_name' => 'احلام',  'last_name' => 'احلام', 'description' => 'asdasdasdasd'],

            ['doctor_id' => 6, 'locale' => 'en', 'first_name' => 'amani', 'last_name' => 'amani', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 6, 'locale' => 'fr', 'first_name' => 'amani', 'last_name' => 'amani', 'description' => 'asdasdasdasd'],
            ['doctor_id' => 6, 'locale' => 'ar', 'first_name' => 'اماني', 'last_name' => 'اماني', 'description' => 'asdasdasdasd'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_translation');
    }
}
