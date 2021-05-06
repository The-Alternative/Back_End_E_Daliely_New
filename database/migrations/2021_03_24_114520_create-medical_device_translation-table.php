<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMedicalDeviceTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_device_translation', function (Blueprint $table) {
            $table->id();
            $table->integer('medical_device_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('medical_device_translation')->insert([

            ['name' => 'alsalam', 'locale' => 'en', 'medical_device_id' => 1],
            ['name' => 'alsalam', 'locale' => 'fr', 'medical_device_id' => 1],
            ['name' => 'السلام',   'locale' => 'ar', 'medical_device_id' => 1],

            ['name' => 'rose',   'locale' => 'en', 'medical_device_id' => 2],
            ['name' => 'rose',    'locale' => 'fr', 'medical_device_id' => 2],
            ['name' => 'ورد',     'locale' => 'ar', 'medical_device_id' => 2],

            ['name' => 'dream',   'locale' => 'en', 'medical_device_id' => 3],
            ['name' => 'dream',    'locale' => 'fr', 'medical_device_id' => 3],
            ['name' => 'حلم',     'locale' => 'ar', 'medical_device_id' => 3],

            ['name' => 'salam2',   'locale' => 'en',  'medical_device_id' => 4],
            ['name' => 'salam2',    'locale' => 'fr', 'medical_device_id' => 4],
            ['name' => 'سلام2',     'locale' => 'ar',  'medical_device_id' => 4],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_device_translation');
    }
}
