<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->foreignId('category_id');
//            $table->unique(['category_id', 'locale']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('language_id');
//            $table->unique(['language_id', 'lang_id']);
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            // Actual fields you want to translate
//            $table->string('title');
//            $table->longText('full_text');
        });
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
