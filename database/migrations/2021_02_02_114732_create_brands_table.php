<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('image');
            $table->boolean('is_active');
            $table->timestamps();
        });
        DB::table('brands')->insert([
            ['slug' => 'Developer',   'image' => 'https://img.lovepik.com/photo/50015/8348.jpg_wh860.jpg',  'is_active' => 1],
            ['slug' => 'Journalist1', 'image' => 'https://i.suar.me/LW5aE/l',                               'is_active' => 1],
            ['slug' => 'Journalist2', 'image' => 'https://suar.me/Nwv3V',                                   'is_active' => 1],
            ['slug' => 'Journalist3', 'image' => 'https://i.suar.me/52029/l',                               'is_active' => 1],
            ['slug' => 'Journalist4', 'image' => 'https://i.suar.me/rN0NE/l',                               'is_active' => 1],
            ['slug' => 'Journalist5', 'image' => 'https://i.suar.me/moJ8j/l',                               'is_active' => 1],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
