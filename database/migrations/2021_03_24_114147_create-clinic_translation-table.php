<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClinicTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_translation', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('clinic_translation')->insert([
            ['name' => 'alsalam', 'locale' => 'en', 'clinic_id' => 1],
            ['name' => 'alsalam', 'locale' => 'fr', 'clinic_id' => 1],
            ['name' => 'السلام',   'locale' => 'ar', 'clinic_id' => 1],

            ['name' => 'rose',   'locale' => 'en', 'clinic_id' => 2],
            ['name' => 'rose',    'locale' => 'fr', 'clinic_id' => 2],
            ['name' => 'ورد',     'locale' => 'ar', 'clinic_id' => 2],

            ['name' => 'dream',   'locale' => 'en', 'clinic_id' => 3],
            ['name' => 'dream',    'locale' => 'fr', 'clinic_id' => 3],
            ['name' => 'حلم',     'locale' => 'ar', 'clinic_id' => 3],

            ['name' => 'salam2',   'locale' => 'en',  'clinic_id' => 4],
            ['name' => 'salam2',    'locale' => 'fr', 'clinic_id' => 4],
            ['name' => 'سلام2',     'locale' => 'ar',  'clinic_id' => 4],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_translation');
    }
}
