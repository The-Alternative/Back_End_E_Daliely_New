<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// use LaravelLocalization;

//define('paginat_count',10);
Route::middleware('auth:api')->get('/user', function (Request $request)
    {
        return $request->user();
    });
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),

        'middleware' => ['api','ChangeLanguage','localize','localizationRedirect','localeViewPath']
//        /,'role:superadministrator|administrator|user']
    ],
 function()
    {
        /**__________________________ Product routes  __________________________**/

        Route::group(['prefix'=>'products','namespace'=>'Product'],function()
            {
                Route::GET('/getAll','ProductsController@getAll');
                Route::GET('/getProductByCategory/{id}','ProductsController@getProductByCategory');
                Route::GET('/getById/{id}','ProductsController@getById');
                Route::POST('/create','ProductsController@create');
                Route::PUT('/update/{id}','ProductsController@update');
                Route::GET('/search/{title}','ProductsController@search');
                Route::PUT('/trash/{id}','ProductsController@trash');
                Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
                Route::GET('/getTrashed','ProductsController@getTrashed');
                Route::DELETE('/delete/{id}','ProductsController@delete');
            });

            Route::group(['prefix'=>'payment','namespace'=>'Stores_Orders'],function()
            {
                Route::Post('/getcheckout','StoresOrderController@getChekOutId');
            });
        /**__________________________ Category routes __________________________**/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@getAll');
                Route::GET('/getById/{id}','CategoriesController@getById');
                Route::GET('/getCategoryBySelf/{id}','CategoriesController@getCategoryBySelf');
                Route::POST('/create','CategoriesController@create');
                Route::PUT('/update/{id}','CategoriesController@update');
                Route::PUT('/trash/{id}','CategoriesController@trash');
                Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
                Route::GET('/search/{name}','CategoriesController@search');
                Route::GET('/getTrashed','CategoriesController@getTrashed');
                Route::DELETE('/delete/{id}','CategoriesController@delete');
            });
        /**__________________________ Section routes  __________________________**/
        Route::group(['prefix'=>'sections','namespace'=>'Category'],function()
        {
            Route::GET('/getAll','SectionsController@getAll');
            Route::GET('/getCategoryBySection','SectionsController@getCategoryBySection');
            Route::GET('/getById/{id}','SectionsController@getById');
            Route::POST('/create','SectionsController@create');
            Route::PUT('/update/{id}','SectionsController@update');
            Route::PUT('/trash/{id}','SectionsController@trash');
            Route::PUT('/restoreTrashed/{id}','SectionsController@restoreTrashed');
            Route::GET('/search/{name}','SectionsController@search');
            Route::GET('/getTrashed','SectionsController@getTrashed');
            Route::DELETE('/delete/{id}','SectionsController@delete');
        });
        /**__________________________ Category routes __________________________**/
        Route::group(['prefix'=>'customfields','namespace'=>'Custom_fields'],function()
            {
                Route::GET('/getAll','CustomFieldsController@getAll');
                Route::GET('/getById/{id}','CustomFieldsController@getById');
                Route::GET('/getCategoryBySelf/{id}','CustomFieldsController@getCategoryBySelf');
                Route::POST('/create','CustomFieldsController@create');
                Route::PUT('/update/{id}','CustomFieldsController@update');
                Route::PUT('/trash/{id}','CustomFieldsController@trash');
                Route::PUT('/restoreTrashed/{id}','CustomFieldsController@restoreTrashed');
                Route::GET('/search/{name}','CustomFieldsController@search');
                Route::GET('/getTrashed','CustomFieldsController@getTrashed');
                Route::DELETE('/delete/{id}','CustomFieldsController@delete');
            });
        /**__________________________ Brand routes    __________________________**/
        Route::group(['prefix'=>'brands','namespace'=>'Brand'],function()
            {
                Route::GET('/getAll','BrandController@getAll');
                Route::GET('/getById/{id}','BrandController@getById');
                Route::POST('/create','BrandController@create');
                Route::PUT('/update/{id}','BrandController@update');
                Route::GET('/search/{title}','BrandController@search');
                Route::PUT('/trash/{id}','BrandController@trash');
                Route::PUT('/restoreTrashed/{id}','BrandController@restoreTrashed');
                Route::GET('/getTrashed','BrandController@getTrashed');
                Route::DELETE('/delete/{id}','BrandController@delete');
            });
        /**__________________________ Language routes __________________________**/
        Route::group(['prefix'=>'languages','namespace'=>'Language'],function()
            {
                Route::POST('/getAll','LanguageController@getAll');
                Route::POST('/getById/{id}','LanguageController@getById');
                Route::POST('/create','LanguageController@create');
                Route::post('/update/{id}','LanguageController@update');
                Route::POST('/search/{title}','LanguageController@search');
                Route::PUT('/trash/{id}','LanguageController@trash');
                Route::PUT('/restoreTrashed/{id}','LanguageController@restoreTrashed');
                Route::POST('/getTrashed','LanguageController@getTrashed');
                Route::DELETE('/delete/{id}','LanguageController@delete');
            });
        /**__________________________ Store routes    __________________________**/
         Route::group(['prefix'=>'stores','namespace'=>'Store'],function ()
            {
                Route::GET('/getAll','StoreController@getAll');
                Route::GET('/getById/{id}','StoreController@getById');
                Route::POST('/create','StoreController@create');
                Route::PUT('/update/{id}','StoreController@update');
                Route::PUT('/trash/{id}','StoreController@trash');
                Route::PUT('/restoreTrashed/{id}','StoreController@restoreTrashed');
                Route::GET('/search/{name}','StoreController@search');
                Route::GET('/getTrashed','StoreController@getTrashed');
                Route::DELETE('/delete/{id}','StoreController@delete');
                Route::GET('/getSectionInStore/{id}','StoreController@getSectionInStore');

                Route::POST('/insertProductToStore','StoresProductsController@insertProductToStore');
                Route::PUT('/updateProductInStore/{id}','StoresProductsController@updateProductInStore');
                Route::PUT('/hiddenProductByQuantity/{id}','StoresProductsController@hiddenProductByQuantity');
                Route::GET('/viewStoresHasProduct/{id}','StoresProductsController@viewStoresHasProduct');
                Route::GET('/viewProductsInStore/{id}','StoresProductsController@viewProductsInStore');
                Route::GET('/rangeOfPrice/{id}','StoresProductsController@rangeOfPrice');

                Route::PUT('/prices/{store_id}','StoresProductsController@updateMultyProductsPricesInStore');
                Route::PUT('/ratio/{store_id}','StoresProductsController@updatePricesPyRatio');



            });
########################## DOCTOR ROUTE #########################################

			/*-------------Doctor Route------------------*/
Route::group(['prefix'=>'doctors','namespace'=>'Doctors'],function () {
    Route::get('/', 'DoctorController@get');
    Route::get('/{id}', 'DoctorController@getById');
    Route::get('/gettrashed', 'DoctorController@getTrashed');
    Route::post('/', 'DoctorController@create');
    Route::put('/{id}', 'DoctorController@update');
    Route::GET('/search/{name}', 'DoctorController@search');
    Route::PUT('/trash/{id}', 'DoctorController@trash');
    Route::delete('/{id}', 'DoctorController@delete');
    Route::PUT('/restoretrashed/{id}', 'DoctorController@restoreTrashed');

    Route::GET('/doctor-social-media/{doctor_id}', 'DoctorController@DoctorSocialMedia');
    Route::GET('/doctor-medical-device/{doctor_id}', 'DoctorController@doctormedicaldevice');
    Route::GET('/hospital-doctor/{doctor_id}', 'DoctorController@doctorhospital');
    Route::GET('/appointment-doctor/{doctor_id}', 'DoctorController@doctorappointment');
    Route::GET('/clinic-doctor/{doctor_id}', 'DoctorController@doctorclinic');
    Route::get('/view-Patient/{doctor_id}','DoctorController@Patient');
    Route::get('/doctor-rate/{doctor_id}','DoctorController@DoctorRate');
    Route::get('/doctor-specialty/{doctor_id}','DoctorController@DoctorSpecialty');

});
     /*-------------Patient Route------------------*/
   Route::group(['prefix'=>'patients','namespace'=>'Patient'],function () {
    Route::get('/','PatientController@getAll');
    Route::get('/{id}','PatientController@getById');
    Route::post('/', 'PatientController@create');
    Route::put('/{id}', 'PatientController@update');
    Route::PUT('/trash/{id}', 'PatientController@trash');
    Route::delete('/{id}', 'PatientController@delete');
    Route::get('/gettrashed', 'PatientController@getTrashed');
    Route::PUT('/restoretrashed/{id}', 'PatientController@restoreTrashed');
});
        /*---------------Doctor Rate Route--------*/
Route::group(['prefix'=>'doctorrate','namespace'=>'DoctorRate'],function () {
    Route::get('/', 'DoctorRateController@get');
    Route::get('/{id}', 'DoctorRateController@getById');
    Route::get('/gettrashed', 'DoctorRateController@getTrashed');
    Route::post('/', 'DoctorRateController@create');
    Route::put('/{id}', 'DoctorRateController@update');
    Route::PUT('/trash/{id}', 'DoctorRateController@trash');
    Route::delete('/{id}', 'DoctorRateController@delete');
    Route::PUT('/restoretrashed/{id}', 'DoctorRateController@restoreTrashed');
});
         /*--------------Social Media Route-------*/
Route::group(['prefix'=>'socialmedia','namespace'=>'SocialMedia'],function () {
    Route::get('/', 'SocialMediaController@get');
    Route::get('/{id}', 'SocialMediaController@getById');
    Route::get('/gettrashed', 'SocialMediaController@getTrashed');
    Route::post('/', 'SocialMediaController@create');
    Route::put('/{id}', 'SocialMediaController@update');
    Route::PUT('/trash/{id}', 'SocialMediaController@trash');
    Route::delete('/{id}', 'SocialMediaController@delete');
    Route::PUT('/restoretrashed/{id}', 'SocialMediaController@restoreTrashed');
});
           /*------------Hospital Route------------*/
Route::group(['prefix'=>'hospitals','namespace'=>'Hospital'],function () {
    Route::get('/', 'HospitalController@get');
    Route::get('/{id}', 'HospitalController@getById');
    Route::get('/gettrashed', 'HospitalController@getTrashed');
    Route::post('/', 'HospitalController@create');
    Route::put('/{id}', 'HospitalController@update');
    Route::GET('search/{name}', 'HospitalController@search');
    Route::PUT('/trash/{id}', 'HospitalController@trash');
    Route::delete('/{id}', 'HospitalController@delete');
    Route::PUT('/restoretrashed/{id}', 'HospitalController@restoreTrashed');


    Route::GET('/doctor-work-in-this-hospital/{id}', 'HospitalController@hospitalsDoctor');
});

        /*---------------Clinic Route-------------*/
Route::group(['prefix'=>'clinic','namespace'=>'Clinic'],function () {
    Route::get('/',          'ClinicController@get');
    Route::get('/{id}', 'ClinicController@getById');
    Route::get('/gettrashed',   'ClinicController@getTrashed');
    Route::post('/',      'ClinicController@create');
    Route::put('/{id}',  'ClinicController@update');
    Route::GET('/search/{name}','ClinicController@search');
    Route::PUT('/trash/{id}',   'ClinicController@trash');
    Route::delete('/{id}','ClinicController@delete');
    Route::PUT('/restoretrashed/{id}', 'ClinicController@restoreTrashed');
});

       /*---------------Medical Device Route-------------*/
Route::group(['prefix'=>'medicaldevices','namespace'=>'MedicalDevice'],function () {
    Route::get('/', 'MedicalDeviceController@get');
    Route::get('/{id}', 'MedicalDeviceController@getById');
    Route::get('/gettrashed', 'MedicalDeviceController@getTrashed');
    Route::post('/', 'MedicalDeviceController@create');
    Route::put('/{id}', 'MedicalDeviceController@update');
    Route::GET('/search/{name}', 'MedicalDeviceController@search');
    Route::PUT('/trash/{id}', 'MedicalDeviceController@trash');
    Route::delete('/{id}', 'MedicalDeviceController@delete');
    Route::PUT('/restoretrashed/{id}', 'MedicalDeviceController@restoreTrashed');

    Route::GET('/get-doctor-by-medical-device/{id}','MedicalDeviceController@getdoctor');
});
        /*---------------Specialty Route-------------*/
Route::group(['prefix'=>'specialties','namespace'=>'Specialty'],function () {
    Route::get('/', 'SpecialtyController@get');
    Route::get('/{id}', 'SpecialtyController@getById');
    Route::get('/gettrashed', 'SpecialtyController@getTrashed');
    Route::post('/', 'SpecialtyController@create');
    Route::put('/{id}', 'SpecialtyController@update');
    Route::GET('/search/{name}', 'SpecialtyController@search');
    Route::PUT('/trash/{id}', 'SpecialtyController@trash');
    Route::delete('/{id}', 'SpecialtyController@delete');
    Route::PUT('/restoretrashed/{id}', 'SpecialtyController@restoreTrashed');

    Route::get('/specialty-doctor/{speciatlty_id}', 'SpecialtyController@DoctorSpecialty');
});
       /*--------------- Calendar Route-------------*/
//Route::group(['prefix'=>'Calendar','namespace'=>'Calendar'],function () {
//    Route::get('/',          'CalendarController@get');
//    Route::get('/{id}', 'CalendarController@getById');
//    Route::post('/create',      'CalendarController@create');
//    Route::put('/{id}',  'CalendarController@update');
//    Route::PUT('/trash/{id}',   'CalendarController@trash');
//    Route::delete('/{id}','CalendarController@delete');
//    Route::PUT('/restoreTrashed/{id}', 'CalendarController@restoreTrashed');
//});
      /*---------------Appointment Route-------------*/
Route::group(['prefix'=>'appointments','namespace'=>'Appointment'],function () {
    Route::get('/', 'AppointmentController@get');
    Route::get('/{id}', 'AppointmentController@getById');
    Route::get('/gettrashed', 'AppointmentController@getTrashed');
    Route::post('/', 'AppointmentController@create');
    Route::put('/{id}', 'AppointmentController@update');
    Route::PUT('/trash/{id}', 'AppointmentController@trash');
    Route::delete('/{id}', 'AppointmentController@delete');
    Route::PUT('/restoretrashed/{id}', 'AppointmentController@restoreTrashed');
});

    /*---------------Active Time Route-------------*/
Route::group(['prefix'=>'activetimes','namespace'=>'ActiveTime'],function () {
    Route::get('/', 'ActiveTimeController@get');
    Route::get('/{id}', 'ActiveTimeController@getById');
    Route::get('/gettrashed', 'ActiveTimeController@getTrashed');
    Route::post('/', 'ActiveTimeController@create');
    Route::put('/{id}', 'ActiveTimeController@update');
    Route::PUT('/trash/{id}', 'ActiveTimeController@trash');
    Route::delete('/{id}', 'ActiveTimeController@delete');
    Route::PUT('/restoretrashed/{id}', 'ActiveTimeController@restoreTrashed');
});

########################## RESTAURANT ROUTE #########################################
     /*-------------Restaurant  Route------------------*/
     Route::group(['prefix'=>'restaurants','namespace'=>'Restaurant'],function () {
         Route::get('/', 'RestaurantController@get');
         Route::get('/{id}', 'RestaurantController@getById');
         Route::get('/gettrashed', 'RestaurantController@getTrashed');
         Route::GET('search/{name}','RestaurantController@search');
         Route::post('/', 'RestaurantController@create');
         Route::put('/{id}', 'RestaurantController@update');
         Route::PUT('trash/{id}', 'RestaurantController@trash');
         Route::PUT('restortrashed/{id}', 'RestaurantController@restoreTrashed');
         Route::delete('/{id}', 'RestaurantController@delete');

         Route::get('/get-type/{restaurant_id}', 'RestaurantController@getType');
         Route::get('/get-category/{restaurant_id}', 'RestaurantController@getCategory');
         Route::get('/get-product/{restaurant_id}', 'RestaurantController@getProduct');

     });
     /*-------------Restaurant Type  Route------------------*/
     Route::group(['prefix'=>'restauranttypes','namespace'=>'RestaurantType'],function () {
         Route::get('/', 'RestaurantTypeController@get');
         Route::get('/{id}', 'RestaurantTypeController@getById');
         Route::post('/', 'RestaurantTypeController@create');
         Route::put('/{id}', 'RestaurantTypeController@update');
         Route::GET('/search/{name}','RestaurantTypeController@search');
         Route::PUT('/trash/{id}', 'RestaurantTypeController@trash');
         Route::get('/gettrashed', 'RestaurantTypeController@getTrashed');
         Route::PUT('/restoretrashed/{id}', 'RestaurantTypeController@restoreTrashed');
         Route::delete('/{id}', 'RestaurantTypeController@delete');

         Route::get('/get-restaurant/{restaurantType_id}', 'RestaurantTypeController@getRestaurant');

     });
     /*-------------Restaurant Category Route------------------*/
     Route::group(['prefix'=>'restaurantcategories','namespace'=>'RestaurantCategory'],function () {
         Route::get('/', 'RestaurantCategoyrController@get');
         Route::get('/{id}', 'RestaurantCategoyrController@getById');
         Route::post('/', 'RestaurantCategoyrController@create');
         Route::put('/{id}', 'RestaurantCategoyrController@update');
         Route::GET('/search/{name}','RestaurantCategoyrController@search');
         Route::PUT('/trash/{id}', 'RestaurantCategoyrController@trash');
         Route::get('/gettrashed', 'RestaurantCategoyrController@getTrashed');
         Route::PUT('/restoretrashed/{id}', 'RestaurantCategoyrController@restoreTrashed');
         Route::delete('/{id}', 'RestaurantCategoyrController@delete');

         Route::get('/get-restaurant/{restaurantCategory_id}', 'RestaurantCategoyrController@getRestaurant');
         Route::get('/get-product/{restaurantCategory_id}', 'RestaurantCategoyrController@getProduct');

     });
     /*-------------Restaurant  Product Route------------------*/
     Route::group(['prefix'=>'restaurantproducts','namespace'=>'RestaurantProduct'],function () {
         Route::get('/', 'RestaurantProductController@get');
         Route::get('/{id}', 'RestaurantProductController@getById');
         Route::post('/', 'RestaurantProductController@create');
         Route::put('/{id}', 'RestaurantProductController@update');
         Route::GET('/search/{name}','RestaurantProductController@search');
         Route::PUT('/trash/{id}', 'RestaurantProductController@trash');
         Route::get('/getTrashed', 'RestaurantProductController@getTrashed');
         Route::PUT('/restoreTrashed/{id}', 'RestaurantProductController@restoreTrashed');
         Route::delete('/{id}', 'RestaurantProductController@delete');

         Route::get('/get-restaurant/{restaurantproduct_id}', 'RestaurantProductController@getRestaurant');
         Route::get('/get-category/{restaurantProduct_id}', 'RestaurantProductController@getCategory');

     });
     /*-------------Item  Route------------------*/
     Route::group(['prefix'=>'items','namespace'=>'Item'],function () {
         Route::get('/', 'ItemController@get');
         Route::get('/{id}', 'ItemController@getById');
         Route::post('/', 'ItemController@create');
         Route::put('/{id}', 'ItemController@update');
         Route::GET('/search/{name}','ItemController@search');
         Route::PUT('/trash/{id}', 'ItemController@trash');
         Route::get('/gettrashed', 'ItemController@getTrashed');
         Route::PUT('/restoretrashed/{id}', 'ItemController@restoreTrashed');
         Route::delete('/{id}', 'ItemController@delete');

         Route::get('/get-restaurant/{item_id}', 'ItemController@getRestaurant');
         Route::get('/get-category/{item_id}', 'ItemController@getCategory');
         Route::get('/get-product/{item_id}', 'ItemController@getProduct');

     });

 });


