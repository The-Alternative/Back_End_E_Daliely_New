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
        'middleware' => ['api','ChangeLanguage','localize','localizationRedirect','localeViewPath'
//            ,'role:superadministrator|administrator|user'
        ]
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
        /**__________________________ Payment routes  __________________________**/
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
    Route::get('/get', 'DoctorController@get');
    Route::get('/getbyid/{id}', 'DoctorController@getById');
    Route::get('/gettrashed', 'DoctorController@getTrashed');
    Route::post('/create', 'DoctorController@create');
    Route::put('/update/{id}', 'DoctorController@update');
    Route::GET('/search/{name}', 'DoctorController@search');
    Route::PUT('/trash/{id}', 'DoctorController@trash');
    Route::delete('/delete/{id}', 'DoctorController@delete');
    Route::PUT('/restoretrashed/{id}', 'DoctorController@restoreTrashed');

    Route::GET('/doctor-social-media/{doctor_id}', 'DoctorController@SocialMedia');
    Route::GET('/doctor-medical-device/{doctor_id}', 'DoctorController@doctormedicaldevice');
    Route::GET('/hospital-doctor/{doctor_id}', 'DoctorController@hospital');
    Route::GET('/appointment-doctor/{doctor_id}', 'DoctorController@appointment');
    Route::GET('/clinic-doctor/{doctor_id}', 'DoctorController@clinic');
    Route::get('/view-customer/{doctor_id}','DoctorController@customer');
    Route::get('/doctor-rate/{doctor_id}','DoctorController@DoctorRate');
    Route::get('/doctor-specialty/{doctor_id}','DoctorController@DoctorSpecialty');

});
///___________Create Patient By Doctor Route ______________//
Route::group(['prefix'=>'patients','namespace'=>'Doctors'],function () {
    Route::get('/get-patient/{id}','CustomerDoctorController@getById');
    Route::post('/create-patient-by-doctor', 'CustomerDoctorController@create');
    Route::put('/update-patient/{id}', 'CustomerDoctorController@update');
    Route::PUT('/trash-patient/{id}', 'CustomerDoctorController@trashpatient');
    Route::delete('/delete-patient/{id}', 'CustomerDoctorController@deletepatient');
    Route::get('/gettrashed-patient', 'CustomerDoctorController@getTrashedpatient');
    Route::PUT('/restoretrashed-patient/{id}', 'CustomerDoctorController@restoreTrashedpatient');
});
/*---------------Doctor Rate Route--------*/
Route::group(['prefix'=>'doctorrate','namespace'=>'DoctorRate'],function () {
    Route::get('/get', 'DoctorRateController@get');
    Route::get('/getbyid/{id}', 'DoctorRateController@getById');
    Route::get('/gettrashed', 'DoctorRateController@getTrashed');
    Route::post('/create', 'DoctorRateController@create');
    Route::put('/update/{id}', 'DoctorRateController@update');
    Route::PUT('/trash/{id}', 'DoctorRateController@trash');
    Route::delete('/delete/{id}', 'DoctorRateController@delete');
    Route::PUT('/restoretrashed/{id}', 'DoctorRateController@restoreTrashed');
});
/*--------------Social Media Route-------*/
Route::group(['prefix'=>'socialmedia','namespace'=>'SocialMedia'],function () {
    Route::get('/get', 'SocialMediaController@get');
    Route::get('/getbyid/{id}', 'SocialMediaController@getById');
    Route::get('/gettrashed', 'SocialMediaController@getTrashed');
    Route::post('/create', 'SocialMediaController@create');
    Route::put('/update/{id}', 'SocialMediaController@update');
    Route::PUT('/trash/{id}', 'SocialMediaController@trash');
    Route::delete('/delete/{id}', 'SocialMediaController@delete');
    Route::PUT('/restoretrashed/{id}', 'SocialMediaController@restoreTrashed');
});
///*------------Hospital Route------------*/
Route::group(['prefix'=>'hospitals','namespace'=>'Hospital'],function () {
    Route::get('/get', 'HospitalController@get');
    Route::get('/getbyid/{id}', 'HospitalController@getById');
    Route::get('/gettrashed', 'HospitalController@getTrashed');
    Route::post('/create', 'HospitalController@create');
    Route::put('/update/{id}', 'HospitalController@update');
    Route::GET('/search/{name}', 'HospitalController@search');
    Route::PUT('/trash/{id}', 'HospitalController@trash');
    Route::delete('/delete/{id}', 'HospitalController@delete');
    Route::PUT('/restoretrashed/{id}', 'HospitalController@restoreTrashed');


    Route::GET('/doctor-work-in-this-hospital/{id}', 'HospitalController@hospitalsDoctor');
});

///*---------------Clinic Route-------------*/
Route::group(['prefix'=>'clinic','namespace'=>'Clinic'],function () {
    Route::get('/get',          'ClinicController@get');
    Route::get('/getbyid/{id}', 'ClinicController@getById');
    Route::get('/gettrashed',   'ClinicController@getTrashed');
    Route::post('/create',      'ClinicController@create');
    Route::put('/update/{id}',  'ClinicController@update');
    Route::GET('/search/{name}','ClinicController@search');
    Route::PUT('/trash/{id}',   'ClinicController@trash');
    Route::delete('/delete/{id}','ClinicController@delete');
    Route::PUT('/restoretrashed/{id}', 'ClinicController@restoreTrashed');
});
/////*---------------Work Place Route-------------*/
//Route::group(['middleware'=>'api','prefix'=>'WorkPlace','namespace'=>'WorkPlace'],function () {
//    Route::get('/get', 'WorkPlaceController@get');
//    Route::get('/getById/{id}', 'WorkPlaceController@getById');
//    Route::get('/getTrashed', 'WorkPlaceController@getTrashed');
//    Route::post('/create', 'WorkPlaceController@create');
//    Route::put('/update/{id}', 'WorkPlaceController@update');
////    Route::GET('/search/{name}', 'WorkPlaceController@search');
//    Route::PUT('/trash/{id}', 'WorkPlaceController@trash');
//    Route::delete('/delete/{id}', 'WorkPlaceController@delete');
//    Route::PUT('/restoreTrashed/{id}', 'WorkPlaceController@restoreTrashed');
//    });
///*---------------Medical Device Route-------------*/
Route::group(['prefix'=>'medicaldevices','namespace'=>'MedicalDevice'],function () {
    Route::get('/get', 'MedicalDeviceController@get');
    Route::get('/getbyid/{id}', 'MedicalDeviceController@getById');
    Route::get('/gettrashed', 'MedicalDeviceController@getTrashed');
    Route::post('/create', 'MedicalDeviceController@create');
    Route::put('/update/{id}', 'MedicalDeviceController@update');
    Route::GET('/search/{name}', 'MedicalDeviceController@search');
    Route::PUT('/trash/{id}', 'MedicalDeviceController@trash');
    Route::delete('/delete/{id}', 'MedicalDeviceController@delete');
    Route::PUT('/restoretrashed/{id}', 'MedicalDeviceController@restoreTrashed');

    Route::GET('/get-doctor-by-medical-device/{id}','MedicalDeviceController@getdoctor');
});
/*---------------Specialty Route-------------*/
Route::group(['prefix'=>'specialties','namespace'=>'Specialty'],function () {
    Route::get('/get', 'SpecialtyController@get');
    Route::get('/getbyid/{id}', 'SpecialtyController@getById');
    Route::get('/gettrashed', 'SpecialtyController@getTrashed');
    Route::post('/create', 'SpecialtyController@create');
    Route::put('/update/{id}', 'SpecialtyController@update');
    Route::GET('/search/{name}', 'SpecialtyController@search');
    Route::PUT('/trash/{id}', 'SpecialtyController@trash');
    Route::delete('/delete/{id}', 'SpecialtyController@delete');
    Route::PUT('/restoretrashed/{id}', 'SpecialtyController@restoreTrashed');

    Route::get('/specialty-doctor/{speciatlty_id}', 'SpecialtyController@DoctorSpecialty');
});
///*--------------- Calendar Route-------------*/
Route::group(['prefix'=>'Calendar','namespace'=>'Calendar'],function () {
    Route::get('/get',          'CalendarController@get');
    Route::get('/getById/{id}', 'CalendarController@getById');
    Route::post('/create',      'CalendarController@create');
    Route::put('/update/{id}',  'CalendarController@update');
    Route::PUT('/trash/{id}',   'CalendarController@trash');
    Route::delete('/delete/{id}','CalendarController@delete');
    Route::PUT('/restoreTrashed/{id}', 'CalendarController@restoreTrashed');
});
///*---------------Appointment Route-------------*/
Route::group(['prefix'=>'appointments','namespace'=>'Appointment'],function () {
    Route::get('/get', 'AppointmentController@get');
    Route::get('/getbyid/{id}', 'AppointmentController@getById');
    Route::get('/gettrashed', 'AppointmentController@getTrashed');
    Route::post('/create', 'AppointmentController@create');
    Route::put('/update/{id}', 'AppointmentController@update');
    Route::PUT('/trash/{id}', 'AppointmentController@trash');
    Route::delete('/delete/{id}', 'AppointmentController@delete');
    Route::PUT('/restoretrashed/{id}', 'AppointmentController@restoreTrashed');
});
///*---------------Customer Route-------------*/
Route::group(['prefix'=>'customers','namespace'=>'Customer'],function () {
    Route::get('/get',          'CustomerController@get');
    Route::get('/getbyid/{id}', 'CustomerController@getById');
    Route::get('/gettrashed',   'CustomerController@getTrashed');
    Route::post('/create',      'CustomerController@create');
    Route::put('/update/{id}',  'CustomerController@update');
    Route::GET('/search/{name}','CustomerController@search');
    Route::PUT('/trash/{id}',   'CustomerController@trash');
    Route::delete('/delete/{id}','CustomerController@delete');
    Route::PUT('/restoretrashed/{id}', 'CustomerController@restoreTrashed');
});
///*---------------Medical File Route-------------*/
Route::group(['prefix'=>'medicalfiles','namespace'=>'MedicalFile'],function () {
    Route::get('/get', 'MedicalFileController@get');
    Route::get('/getbyid/{id}', 'MedicalFileController@getById');
    Route::get('/gettrashed', 'MedicalFileController@getTrashed');
    Route::post('/create', 'MedicalFileController@create');
    Route::put('/update/{id}', 'MedicalFileController@update');
    Route::PUT('/trash/{id}', 'MedicalFileController@trash');
    Route::delete('/delete/{id}', 'MedicalFileController@delete');
    Route::PUT('/restoretrashed/{id}', 'MedicalFileController@restoreTrashed');
});
///*---------------Active Time Route-------------*/
Route::group(['prefix'=>'activetimes','namespace'=>'ActiveTime'],function () {
    Route::get('/get', 'ActiveTimeController@get');
    Route::get('/getbyid/{id}', 'ActiveTimeController@getById');
    Route::get('/gettrashed', 'ActiveTimeController@getTrashed');
    Route::post('/create', 'ActiveTimeController@create');
    Route::put('/update/{id}', 'ActiveTimeController@update');
    Route::PUT('/trash/{id}', 'ActiveTimeController@trash');
    Route::delete('/delete/{id}', 'ActiveTimeController@delete');
    Route::PUT('/restoretrashed/{id}', 'ActiveTimeController@restoreTrashed');
});
########################## RESTAURANT ROUTE #########################################
//________________________Restaurant Route__________________//
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
     //________________________ Restaurant Type Route__________________//
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
     //________________________ Restaurant Category Route__________________//
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
     //________________________ Restaurant Product Route__________________//
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
     //________________________ Item Route__________________//
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


