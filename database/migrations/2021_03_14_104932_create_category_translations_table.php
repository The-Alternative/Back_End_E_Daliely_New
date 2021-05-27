<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->bigIncrements('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
//            $table->foreignId('categories_id');
            $table->string('name')->index();
            $table->string('local')->index();
//            $table->unsignedInteger('language_id')->index();

            // Foreign key to the main model
//            $table->integer('category_id');
//            $table->unique(['category_id', 'locale']);
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->integer('language_id');
//            $table->unique(['language_id', 'lang_id']);
            $table->integer('language_id')->references('id')->on('languages')->onDelete('cascade');

            // Actual fields you want to translate
//            $table->string('title');
//            $table->longText('full_text');
        });
        DB::table('category_translations')->insert([
            ['name' => 'Developer',   'local' => 'en', 'category_id' => 1,'language_id' => 1],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 1, 'language_id' => 1],
            ['name' => 'Journalist2', 'local' => 'en', 'category_id' => 2, 'language_id' => 2],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 2, 'language_id' => 2],
            ['name' => 'Journalist4', 'local' => 'en', 'category_id' => 3, 'language_id' => 3],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 3, 'language_id' => 3],
            ['name' => 'Journalist6', 'local' => 'en', 'category_id' => 4, 'language_id' => 4],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 4, 'language_id' => 4],
            ['name' => 'Journalist8', 'local' => 'en', 'category_id' => 5, 'language_id' => 5],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 5, 'language_id' => 5],
            ['name' => 'Journalist10', 'local' => 'en', 'category_id' => 6, 'language_id' =>6],
            ['name' => 'عربي', 'local' => 'ar', 'category_id' => 6, 'language_id' =>6],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_translations');
    }
}
