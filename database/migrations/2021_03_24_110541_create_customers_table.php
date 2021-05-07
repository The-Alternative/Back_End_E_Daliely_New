<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('social_media_id')->unsigned();
            $table->boolean('is_active');
            $table->boolean('is_approved');
            $table->timestamps();
        });
        DB::table('customers')->insert([
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 1],
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 2],
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 3],
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 4],
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 5],
            [ 'is_approved' => 1, 'is_active' => 1, 'social_media_id' => 6]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
