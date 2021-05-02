<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id');
            $table->string('title');
            $table->string('local');
            $table->timestamps();
        });
        DB::table('store_translations')->insert([
            ['title' => 'AlREEM CENTER',             'store_id' =>1,'local' => 'en' ],
            ['title' => 'لریم سنتر-سوبر ماركت',      'store_id' =>1,'local' => 'ar' ],
            ['title' => 'AMIRS CENTER',              'store_id' =>2,'local' => 'en' ],
            ['title' => 'سنتر امیرة-سوبر ماركت',     'store_id' =>2,'local' => 'ar' ],
            ['title' => 'ALMASRI CENTER',            'store_id' =>3,'local' => 'en' ],
            ['title' => 'سنتر المصري-سوبر ماركت',    'store_id' =>3,'local' => 'ar' ],
            ['title' => 'ALSHAHEEN',                 'store_id' =>4,'local' => 'en' ],
            ['title' => 'شركة شاھین - مكیاجات',      'store_id' =>4,'local' => 'ar' ],
            ['title' => 'ALRABEE CENTER',            'store_id' =>5,'local' => 'en' ],
            ['title' => 'سنتر الربيع - سوبر ماركت ', 'store_id' =>5,'local' => 'ar' ],
            ['title' => 'ALAHMAD CENTER',            'store_id' =>6,'local' => 'en' ],
            ['title' => 'سنتر الاحمد-سوبر ماركت',     'store_id' =>6,'local' => 'ar' ],
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_translations');
    }
}
