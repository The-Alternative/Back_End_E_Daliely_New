<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoresSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('store_id');
            $table->timestamps();
        });
        DB::table('stores_sections')->insert([
            ['section_id'=>1,'store_id'=>1],
            ['section_id'=>2,'store_id'=>1],
            ['section_id'=>4,'store_id'=>1],
            ['section_id'=>5,'store_id'=>1],
            ['section_id'=>6,'store_id'=>1],
            ['section_id'=>7,'store_id'=>1],
            ['section_id'=>8,'store_id'=>1],
            ['section_id'=>9,'store_id'=>1],
            ['section_id'=>10,'store_id'=>1],
            ['section_id'=>11,'store_id'=>1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores_sections');
    }
}
