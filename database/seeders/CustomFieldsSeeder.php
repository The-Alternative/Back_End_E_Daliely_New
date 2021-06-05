<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++){
            $s=DB::table('custom_fields')->insertGetId([
                'image' =>Str::random(10),
                'is_active' =>1
            ]);
            DB::table('custom__fields__translations')->insert([[
                'name' =>Str::random(10),
                'local' =>'ar',
                'description' =>Str::random(200),
                'custom_field_id' => $s
            ],
                [
                    'name' =>Str::random(10),
                    'local' =>'en',
                    'description' =>Str::random(200),
                    'custom_field_id' => $s
                ]]);

        }
    }
}
