<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
        });
        for($section_id=1;$section_id<12;$section_id++){
            for($product_id=1;$product_id<12;$product_id++) {
                DB::table('products_sections')->insert(
                    $arr = [
                        'section_id'=>$section_id,
                        'product_id'=>$product_id
                    ]
                );
            }
        }
        DB::table('products_sections')->insert([
            ['product_id'=>1,'section_id'=>1],
            ['product_id'=>2,'section_id'=>1],
            ['product_id'=>4,'section_id'=>1],
            ['product_id'=>5,'section_id'=>1],
            ['product_id'=>6,'section_id'=>1],
            ['product_id'=>7,'section_id'=>1],
            ['product_id'=>8,'section_id'=>1],
            ['product_id'=>9,'section_id'=>1],
            ['product_id'=>10,'section_id'=>1],
            ['product_id'=>11,'section_id'=>1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_sections');
    }
}
