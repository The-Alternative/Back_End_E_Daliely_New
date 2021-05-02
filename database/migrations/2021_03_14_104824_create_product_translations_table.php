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
            ['name' => 'Xiaomi Redmi Note',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'en','product_id' => 6 ],
            ['name' => 'Xiaomi Redmi Note',              'short_des' => 'Xiaomi Redmi Note',           'long_des' => 'Developer Developer','meta' => 'Developer','local' => 'ar','product_id' => 6 ],
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
