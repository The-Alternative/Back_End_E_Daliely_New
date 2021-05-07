<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('locale');

            $table->timestamps();
        });
        DB::table('customer_translations')->insert([
            [ 'customer_id'=>1, 'first_name' => 'asmar',  'last_name' => 'asmar', 'address'=>'alswaida', 'locale' => 'en' ],
            [ 'customer_id'=>1, 'first_name' => 'asmar',  'last_name' => 'asmar', 'address'=>'alswaida', 'locale' => 'fr' ],
            [ 'customer_id'=>1, 'first_name' => 'اسمر',   'last_name' => 'اسمر',  'address'=>'السويداء', 'locale' => 'ar' ],

            [ 'customer_id'=>2,  'first_name' => 'hammam', 'last_name' => 'hammam', 'address'=>'Damascus', 'locale' => 'en'],
            [ 'customer_id'=>2,  'first_name' => 'hammam', 'last_name' => 'hammam', 'address'=>'Damascus', 'locale' => 'fr'],
            [ 'customer_id'=>2,  'first_name' => 'همام',   'last_name' => 'همام',  'address'=>'دمشق', 'locale' => 'ar'],

            [ 'customer_id'=>3, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'en'],
            [ 'customer_id'=>3, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'fr'],
            [ 'customer_id'=>3, 'first_name' => 'احلام',  'last_name' => 'احلام',   'address'=>'حمص',     'locale' => 'ar' ],

            [ 'customer_id'=>4, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'en'],
            [ 'customer_id'=>4, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'fr'],
            [ 'customer_id'=>4, 'first_name' => 'احلام',  'last_name' => 'احلام',   'address'=>'حمص',     'locale' => 'ar' ],

            [ 'customer_id'=>5, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'en'],
            [ 'customer_id'=>5, 'first_name' => 'ahlam', 'last_name' => 'ahlam',  'address'=>'homs', 'locale' => 'fr'],
            [ 'customer_id'=>5, 'first_name' => 'احلام',  'last_name' => 'احلام',   'address'=>'حمص',     'locale' => 'ar' ],

            [ 'customer_id'=>6, 'first_name' => 'ahmad', 'last_name' => 'ahmad','address'=>'alswaida', 'locale' => 'en'],
            [ 'customer_id'=>6, 'first_name' => 'ahmad', 'last_name' => 'ahmad','address'=>'alswaida', 'locale' => 'fr'],
            [ 'customer_id'=>6, 'first_name' => 'احمد',  'last_name' => 'احمد', 'address'=>'السويداء', 'locale' => 'ar'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_translations');
    }
}
