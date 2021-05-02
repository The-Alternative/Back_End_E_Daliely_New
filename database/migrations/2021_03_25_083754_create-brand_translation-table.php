<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_translation', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('locale');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('brand_translation')->insert([
            ['name' => 'NYX',              'description' => 'NYX',             'brand_id' =>1,'locale' => 'en' ],
            ['name' => 'أن واي أكس',       'description' => 'أن واي أكس',      'brand_id' =>1,'locale' => 'ar' ],
            ['name' => 'Green Apple',      'description' => 'Green Apple',     'brand_id' =>2,'locale' => 'en' ],
            ['name' => 'التفاحة الخضراء',  'description' => 'التفاحة الخضراء', 'brand_id' =>2,'locale' => 'ar' ],
            ['name' => 'SAMSUNG',          'description' => 'SAMSUNG',         'brand_id' =>3,'locale' => 'en' ],
            ['name' => 'سامسونج',          'description' => 'سامسونج',         'brand_id' =>3,'locale' => 'ar' ],
            ['name' => 'PUMA',             'description' => 'PUMA',            'brand_id' =>4,'locale' => 'en' ],
            ['name' => 'باما',             'description' => 'باما',            'brand_id' =>4,'locale' => 'ar' ],
            ['name' => 'apple',            'description' => 'apple',           'brand_id' =>5,'locale' => 'en' ],
            ['name' => 'تفاحة',            'description' => 'تفاحة',           'brand_id' =>5,'locale' => 'ar' ],
            ['name' => 'adidas',           'description' => 'adidas',          'brand_id' =>6,'locale' => 'en' ],
            ['name' => 'اديداس',           'description' => 'اديداس',          'brand_id' =>6,'locale' => 'ar' ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_translation');
    }
}
