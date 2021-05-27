<?php

namespace Database\Factories;

use App\Models\Doctors\doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        for ($i = 1; $i <= 100; $i++) {
            $s = DB::table('doctors')->insertGetId([
                'image' => $this->faker->sentence(5),
                'is_active' => 1,
                'is_approved' =>1,
                'social_media_id' => 1,
                'hospital_id' => 1,
                'clinic_id' => 1,
                'specialty_id' => 1
            ]);
            DB::table('doctor_translations')->insert([[
                'first_name' => $this->faker->sentence(2),
                'last_name' => $this->faker->sentence(2),
                'local' => 'en',
                'description' => $this->faker->sentence(10),
                'doctor_id' => $s
            ],
                [
                    'first_name' => $this->faker->sentence(2),
                    'last_name' => $this->faker->sentence(2),
                    'local' => 'ar',
                    'description' => $this->faker->sentence(10),
                    'doctor_id' => $s
                ]]);

        }
    }


}
