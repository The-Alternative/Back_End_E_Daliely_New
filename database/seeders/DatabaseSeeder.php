<?php

namespace Database\Seeders;

use App\Models\DoctorRate\DoctorRate;
use App\Models\RestaurantType\RestaurantType;
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
//         \App\Models\User::factory(10)->create();
        $this->call([
            LaratrustSeeder::class,
            RolePermissionSeeder::class,
            BrandSeeder::class,
            ProductSectionSeeder::class,
            BrandSectionSeeder::class,
            brandImagesSeeder::class,
            CategoriesSeeder::class,
            CustomFieldSeeder::class,
            CustomField_CustomFieldValue::class,
            CustomFieldImagesSeeder::class,
            CategoriesImagesSeeder::class,
            ProductCategorySeeder::class,
            ProductImageSeeder::class,
            ProductCustomFieldSeeder::class,
            ProductsSeeder::class,
            SectionSeeder::class,
            StoreBrandSeeder::class,
            StoreProductSeeder::class,
            StoreSectionSeeder::class,
            StoreSeeder::class,
            StoreImagesSeeder::class,
            DoctorSpecialtySeeder::class,
            CustomerDoctorSeeder::class,
            DoctorHospitalSeeder::class,
            DoctorMedicalDeviceSeeder::class,
            DoctorRateSeeder::class,
            ProductsSeeder::class,
            StoreSeeder::class,
            StoreImagesSeeder::class,
            DoctorSeeder::class,
            ActiveTimeSedeer::class,
            appointmentSedeer::class,
            ClinicSedeer::class,
            CustomerSedeer::class,
            HospitalSedeer::class,
            HospitalMedicalDeviceSeeder::class,
            MedicalDeviceSedeer::class,
            MedicalFileSedeer::class,
            SocialMediaSedeer::class,
            SpecialtySedeer::class,

            RestaurantSeeder::class,
            RestaurantTypeSeeder::class,
            RestaurantTypeRestaurantSeeder::class,
            RestaurantCategorySeeder::class,
            RestaurantProductSeeder::class,
            ItemSeeder::class,
            RestauranCategoryItemSeeder::class,
            RestauranCategoryProductSeeder::class,
            RestaurantItemSeeder::class,
            RestaurantRestauranCategorySeeder::class,
            RestaurantRestauranProductSeeder::class,


        ]);

    }
}
