<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoresProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_products', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD

           // $table->unsignedInteger('store_id');
          //  $table->unsignedInteger('product_id');
//            $table->unsignedInteger('price');
//            $table->unsignedInteger('quantity');

=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
            $table->unsignedInteger('store_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->boolean('is_active');
            $table->boolean('is_appear');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
