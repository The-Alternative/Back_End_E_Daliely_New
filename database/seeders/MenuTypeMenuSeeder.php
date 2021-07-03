<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTypeMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($menu_id = 1; $menu_id < 5; $menu_id++) {
            for ($menu_type_id = 1; $menu_type_id < 5; $menu_type_id++) {
                DB::table('menu_menu_type')->insert(
                    [
                        'menu_type_id' => $menu_type_id,
                        'menu_id' => $menu_id
                    ]
                );
            }
        }
    }
}
