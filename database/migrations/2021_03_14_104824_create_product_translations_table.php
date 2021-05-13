<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_des');
            $table->string('long_des');
            $table->string('meta');
            $table->string('local');
            $table->unsignedInteger('product_id');
            $table->timestamps();
        });

        DB::table('product_translations')->insert([
            ['name' => 'Dry water color box 12 colors',  'short_des' =>'Dry water color box 12 colors','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 1 ],
            ['name' => 'علبة الوان مائیة جافة 12 لون',   'short_des' => 'علبة الوان مائیة جافة 12 لون','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 1 ],
            ['name' => 'NYX nail polish',                'short_des' => 'NYX nail polish',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 2 ],
            ['name' => 'طلاء أظافر من NYX',               'short_des' => 'طلاء أظافر من NYX',            'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 2 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 3 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 3 ],
            ['name' => 'A small water thermos',          'short_des' => 'A small water thermos',       'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 4 ],
            ['name' => 'ترمس ماء صغیر',                  'short_des' => 'ترمس ماء صغیر',               'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 4 ],
            ['name' => 'Xiaomi Redmi 9 Prime',           'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 5 ],
            ['name' => 'Xiaomi Redmi 9 Prime ',          'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 5 ],
            ['name' => 'Xiaomi Redmi Note10',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 6 ],
            ['name' => 'Xiaomi Redmi Note10',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 6 ],
            ['name' => 'Dry water color box 24 colors',  'short_des' =>'Dry water color box 12 colors','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 7 ],
            ['name' => 'علبة الوان مائیة جافة 24 لون',   'short_des' => 'علبة الوان مائیة جافة 12 لون','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 7 ],
            ['name' => 'NYX nail polish',                'short_des' => 'NYX nail polish',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 8 ],
            ['name' => 'طلاء أظافر من NYX',               'short_des' => 'طلاء أظافر من NYX',            'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 8 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 9 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 9 ],
            ['name' => 'A big water thermos',          'short_des' => 'A small water thermos',       'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 10 ],
            ['name' => 'ترمس ماء كبير',                  'short_des' => 'ترمس ماء صغیر',               'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 10 ],
            ['name' => 'Xiaomi Redmi 9 proMax',           'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 11 ],
            ['name' => 'Xiaomi Redmi 9 proMax ',          'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 11 ],
            ['name' => 'Xiaomi Redmi Note9',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 12 ],
            ['name' => 'Xiaomi Redmi Note9',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 12 ],
            ['name' => 'Dry water color box 12 colors',  'short_des' =>'Dry water color box 12 colors','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 13 ],
            ['name' => 'علبة الوان مائیة جافة 12 لون',   'short_des' => 'علبة الوان مائیة جافة 12 لون','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 13 ],
            ['name' => 'NYX nail polish',                'short_des' => 'NYX nail polish',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 14 ],
            ['name' => 'طلاء أظافر من NYX',               'short_des' => 'طلاء أظافر من NYX',            'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 14 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 15 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 15 ],
            ['name' => 'A small water thermos',          'short_des' => 'A small water thermos',       'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 16 ],
            ['name' => 'ترمس ماء صغیر',                  'short_des' => 'ترمس ماء صغیر',               'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 16 ],
            ['name' => 'Xiaomi Redmi 9 Prime',           'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 17 ],
            ['name' => 'Xiaomi Redmi 9 Prime ',          'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 17 ],
            ['name' => 'Xiaomi Redmi Note10',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 18 ],
            ['name' => 'Xiaomi Redmi Note10',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 18 ],
            ['name' => 'Dry water color box 24 colors',  'short_des' =>'Dry water color box 12 colors','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 19 ],
            ['name' => 'علبة الوان مائیة جافة 24 لون',   'short_des' => 'علبة الوان مائیة جافة 12 لون','long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 19 ],
            ['name' => 'NYX nail polish',                'short_des' => 'NYX nail polish',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 20 ],
            ['name' => 'طلاء أظافر من NYX',               'short_des' => 'طلاء أظافر من NYX',            'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 20 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 21 ],
            ['name' => 'Xiaomi OPPO A52',                'short_des' => 'Xiaomi OPPO A52',             'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 21 ],
            ['name' => 'A big water thermos',          'short_des' => 'A small water thermos',       'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 22 ],
            ['name' => 'ترمس ماء كبير',                  'short_des' => 'ترمس ماء صغیر',               'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 22 ],
            ['name' => 'Xiaomi Redmi 9 proMax',           'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 23 ],
            ['name' => 'Xiaomi Redmi 9 proMax ',          'short_des' => 'Xiaomi Redmi 9 Prime',        'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 23 ],
            ['name' => 'Xiaomi Redmi Note9',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 24 ],
            ['name' => 'Xiaomi Redmi Note9',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 24 ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_translations');
    }
}
