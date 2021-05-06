<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->boolean('is_active');
            $table->unsignedInteger('parent_id');
            $table->string('image');
            $table->integer('lang_id')->unsigned();
            $table->integer('section_id')->unsigned();
           $table->timestamps();

        });
        DB::table('categories')->insert([
            ['slug' => 'Developer', 'image' => 'https://img.lovepik.com/photo/50015/8348.jpg_wh860.jpg', 'lang_id' => 1,'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
            ['slug' => 'Journalist1', 'image' => 'https://i.suar.me/LW5aE/l', 'lang_id' => 1, 'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
            ['slug' => 'Journalist2', 'image' => 'https://suar.me/Nwv3V', 'lang_id' => 1, 'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
            ['slug' => 'Journalist3', 'image' => 'https://i.suar.me/52029/l', 'lang_id' => 1, 'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
            ['slug' => 'Journalist4', 'image' => 'https://i.suar.me/rN0NE/l', 'lang_id' => 1, 'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
            ['slug' => 'Journalist5', 'image' => 'https://i.suar.me/moJ8j/l', 'lang_id' => 1, 'parent_id' => 1, 'section_id' => 1, 'is_active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
