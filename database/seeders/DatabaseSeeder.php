<?php

namespace Database\Seeders;

use App\Models\DoctorRate\DoctorRate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //store
            BrandSectionSeeder::class,
            BrandSeeder::class,
            CategoriesSeeder::class,
            CustomFieldSeeder::class,
            ProductCategorySeeder::class,
            ProductCustomFieldSeeder::class,
            ProductsSeeder::class,
            SectionSeeder::class,
            StoreBrandSeeder::class,
            StoreProductSeeder::class,
            StoreSectionSeeder::class,
            StoreSeeder::class,
<<<<<<< HEAD
            //doctor
=======
           //doctor
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
            DoctorSpecialtySeeder::class,
            CustomerDoctorSeeder::class,
            DoctorHospitalSeeder::class,
            DoctorMedicalDeviceSeeder::class,
            DoctorRateSeeder::class,
            ProductsSeeder::class,
            DoctorSeeder::class,
            ActiveTimeSedeer::class,
            appointmentSedeer::class,
            ClinicSedeer::class,
            CustomerSedeer::class,
            HospitalSedeer::class,
            MedicalDeviceSedeer::class,
            MedicalFileSedeer::class,
            SocialMediaSedeer::class,
            SpecialtySedeer::class,
<<<<<<< HEAD

=======
//restaurant
//            RestaurantSeeder::class,
>>>>>>> 55c7ce8571894fbf4debf8d3b329d253f0d5c509
        ]);

    }
}
