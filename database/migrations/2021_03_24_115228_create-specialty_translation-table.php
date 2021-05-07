<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_translation', function (Blueprint $table) {
            $table->id();
            $table->integer('specialty_id');
            $table->string('locale');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('specialty_translation')->insert([
            ['locale' => 'en', 'specialty_id'=>1, 'name'=>'asd'],
            ['locale' => 'fr', 'specialty_id'=>1, 'name'=>'asd'],
            ['locale' => 'ar', 'specialty_id'=>1, 'name'=>'مممم'],

            ['locale' => 'en', 'specialty_id'=>2, 'name'=>'asd' ],
            ['locale' => 'fr', 'specialty_id'=>2, 'name'=>'asd' ],
            ['locale' => 'ar', 'specialty_id'=>2, 'name'=>'لالا' ],

            ['locale' => 'en', 'specialty_id'=>3, 'name'=>'asd'],
            ['locale' => 'fr', 'specialty_id'=>3, 'name'=>'asd'],
            ['locale' => 'ar', 'specialty_id'=>3, 'name'=>'بوبو'],

            ['locale' => 'en', 'specialty_id'=>4, 'name'=>'asd'],
            ['locale' => 'fr', 'specialty_id'=>4, 'name'=>'asd'],
            ['locale' => 'ar', 'specialty_id'=>4, 'name'=>'سيبيس'],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialty_translation');
    }
}
