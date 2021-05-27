<?php

namespace Database\Factories;

use App\Models\Doctors\doctor;
use App\Models\Doctors\DoctorTranslation;
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
    protected $model = DoctorTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//       return[
//                'image' => $this->faker->sentence(5),
//                'is_active' => 1,
//                'is_approved' =>1,
//                'social_media_id' => 1,
//                'appointments_id'=>1,
//                'hospital_id' => 1,
//                'clinic_id' => 1,
//                'specialty_id' => 1
//            ];
        return
            [
                'first_name' => $this->faker->sentence(2),
                'last_name' => $this->faker->sentence(2),
                'local' => 'en',
                'description' => $this->faker->sentence(10),
                'doctor_id' => 1
            ];
//                [
//                    'first_name' => $this->faker->sentence(2),
//                    'last_name' => $this->faker->sentence(2),
//                    'local' => 'ar',
//                    'description' => $this->faker->sentence(10),
//                    'doctor_id' =>1
//                ];

        }
    }



