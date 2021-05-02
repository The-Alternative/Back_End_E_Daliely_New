<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBrandSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('brands_id')->unsigned();
            $table->integer('sections_id')->unsigned();
            $table->timestamps();
        });
        DB::table('brand_sections')->insert([

            ['brands_id'=>1,'sections_id'=>2],
            ['brands_id'=>2,'sections_id'=>2],
            ['brands_id'=>1,'sections_id'=>1],
            ['brands_id'=>4,'sections_id'=>3],
            ['brands_id'=>1,'sections_id'=>3]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_sections');
    }
}
