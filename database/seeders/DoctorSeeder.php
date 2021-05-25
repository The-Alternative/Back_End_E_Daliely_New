<?php

namespace Database\Seeders;

use App\Models\Doctors\doctor;
use Database\Factories\DoctorFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Factory(doctor::class)->create();
    }
}
