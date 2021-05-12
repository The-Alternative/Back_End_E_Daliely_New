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
        for($sections_id=1;$sections_id<12;$sections_id++){
            for($brands_id=1;$brands_id<12;$brands_id++) {
                DB::table('brand_sections')->insert(
                    $arr = [
                        'brands_id'=>$brands_id,
                        'sections_id'=>$sections_id
                    ]
                );
            }
        }

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
