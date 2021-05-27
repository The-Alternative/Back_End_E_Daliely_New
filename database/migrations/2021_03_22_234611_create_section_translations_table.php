<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('local');
            $table->unsignedInteger('section_id')->index();
            $table->timestamps();
        });
        DB::table('section_translations')->insert([
            ['name' => 'grocery shop','description' => 'Developer','local' => 'en','section_id' => 1 ],
            ['name' => 'البقالة','description' => 'Developer','local' => 'ar','section_id' => 1 ],
            ['name' => 'fruits and vegetables','description' => 'Developer','local' => 'en','section_id' => 2 ],
            ['name' => 'خضار وفواكة','description' => 'Developer','local' => 'ar','section_id' => 2 ],
            ['name' => 'Fashion','description' => 'Developer','local' => 'en','section_id' => 3 ],
            ['name' => 'ازياء','description' => 'Developer','local' => 'ar','section_id' => 3 ],
            ['name' => 'Bakeries and Sweets','description' => 'Developer','local' => 'en','section_id' => 4 ],
            ['name' => 'مخابز وحلويات','description' => 'Developer','local' => 'ar','section_id' => 4 ],
            ['name' => 'Computers and accessories','description' => 'Developer','local' => 'en','section_id' => 5 ],
            ['name' => 'كمبوترات واكسسوارات ','description' => 'Developer','local' => 'ar','section_id' => 5 ],
            ['name' => 'Electrical and electronic devices','description' => 'Developer','local' => 'en','section_id' => 6 ],
            ['name' => 'اجهزة كهربائية والكترونية','description' => 'Developer','local' => 'ar','section_id' => 6 ],
           ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_translations');
    }
}
