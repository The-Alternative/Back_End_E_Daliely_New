<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// use LaravelLocalization;

Route::middleware('auth:api')->get('/user', function (Request $request)
    {
        return $request->user();
    });
Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['api','ChangeLanguage','localize','localizationRedirect','localeViewPath']
    ],
 function()
    {
        /*_____________ Product routes _____________*/
        Route::group(['prefix'=>'products','namespace'=>'Product'],function()
            {
                Route::GET('/getAll','ProductsController@getAll')->name('products/');
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
        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@getAll')->name('categories/');
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
        /*_____________ Section routes_____________*/
        Route::group(['prefix'=>'sections','namespace'=>'Category'],function()
        {
            Route::GET('/getAll','SectionsController@getAll')->name('sections/');
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
        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'customfields','namespace'=>'Custom_fields'],function()
        {
            Route::GET('/getAll','CustomFieldsController@getAll')->name('customfields/');
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
        /*_____________ Brand routes_____________*/
        // Route::group(['prefix'=> 'brands'] ,function ()
        //     {
        //         Route::get('/',  'Brand\BrandController@getAllBrands');
        //         Route::get('/{id}',  'Brand\BrandController@getBrandsById');
        //         Route::post('createNewBrand',  'Brand\BrandController@createNewBrands');
        //         Route::put('/updateBrand/{id}',  'Brand\BrandController@updateBrand');
        //         Route::put('/deleteBrand/{id}',  'Brand\BrandController@deleteBrand');
        //     });
        /*_____________ Language routes_____________*/
        Route::group(['prefix'=>'languages','namespace'=>'Language'],function(){
            Route::POST('/getAll','LanguageController@getAll')->name('languages/');
            Route::POST('/getById/{id}','LanguageController@getById');
            Route::POST('/create','LanguageController@create');
            Route::post('/update/{id}','LanguageController@update');
            Route::POST('/search/{title}','LanguageController@search');
            Route::PUT('/trash/{id}','LanguageController@trash');
            Route::PUT('/restoreTrashed/{id}','LanguageController@restoreTrashed');
            Route::POST('/getTrashed','LanguageController@getTrashed');
            Route::DELETE('/delete/{id}','LanguageController@delete');
        });
        /*_____________ Store routes_____________*/
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

            });
    });////////////////////end of localization//////////////////////






//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
/*_____________ Product routes _____________*/
//Route::group(['middleware' =>'api','prefix'=>'products','namespace'=>'Product'],function(){
//        Route::GET('/get','ProductsController@get');
//        Route::GET('/getById/{id}','ProductsController@getById');
//        Route::POST('/create','ProductsController@create');
//        Route::PUT('/update/{id}','ProductsController@update');
//        Route::GET('/search/{title}','ProductsController@search');
//        Route::PUT('/trash/{id}','ProductsController@trash');
//        Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
//        Route::GET('/getTrashed','ProductsController@getTrashed');
//        Route::DELETE('/delete/{id}','ProductsController@delete');
//});
//
///*_____________Category routes_____________*/
//Route::group(['middleware' =>'api','prefix'=>'categories','namespace'=>'Category'],function(){
//        Route::GET('/get','CategoriesController@get');
//        Route::GET('/getById/{id}','CategoriesController@getById');
//        Route::POST('/create','CategoriesController@create');
//        Route::PUT('/update','CategoriesController@update');
//        Route::PUT('/trash/{id}','CategoriesController@trash');
//        Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
//        Route::GET('/search/{name}','CategoriesController@search');
//        Route::GET('/getTrashed','CategoriesController@getTrashed');
//        Route::DELETE('/delete/{id}','CategoriesController@delete');
//});
//
//
//
//
//
//
//

/*-------------Doctor Route------------------*/
Route::group(['prefix'=>'doctor','namespace'=>'Doctors'],function () {
    Route::get('/get', 'DoctorController@get');
    Route::get('/getById/{id}', 'DoctorController@getById');
    Route::get('/getTrashed', 'DoctorController@getTrashed');
    Route::post('/create', 'DoctorController@create');
    Route::put('/update/{id}', 'DoctorController@update');
    Route::GET('/search/{name}', 'DoctorController@search');
    Route::PUT('/trash/{id}', 'DoctorController@trash');
    Route::delete('/delete/{id}', 'DoctorController@delete');
    Route::PUT('/restoreTrashed/{id}', 'DoctorController@restoreTrashed');

    Route::GET('/Doctor-social-media/{doctor_name}', 'DoctorController@SocialMedia');
//    Route::GET('/doctor-work-place/{doctor_name}', 'DoctorController@workplace');
    Route::GET('/doctor-medical-device/{doctor_name}', 'DoctorController@doctormedicaldevice');
    Route::GET('/hospital-doctor/{doctor_name}', 'DoctorController@hospital');
    Route::GET('/appointment-doctor/{doctor_name}', 'DoctorController@appointment');
    Route::GET('/clinic-doctor/{doctor_name}', 'DoctorController@clinic');
    Route::get('/view-customer/{doctor_name}','DoctorController@customer');
    Route::GET('/doctor-details/{doctor_name}', 'DoctorController@getalldetails');
    Route::get('/doctor-rate/{doctor_name}','DoctorController@DoctorRate');

    Route::post('/create-customer-by-doctor','DoctorController@createcustomer');

});
/*---------------Doctor Rate Route--------*/
Route::group(['prefix'=>'DoctorRate','namespace'=>'DoctorRate'],function () {
    Route::get('/get', 'DoctorRateController@get');
    Route::get('/getById/{id}', 'DoctorRateController@getById');
    Route::get('/getTrashed', 'DoctorRateController@getTrashed');
    Route::post('/create', 'DoctorRateController@create');
    Route::put('/update/{id}', 'DoctorRateController@update');
    Route::PUT('/trash/{id}', 'DoctorRateController@trash');
    Route::delete('/delete/{id}', 'DoctorRateController@delete');
    Route::PUT('/restoreTrashed/{id}', 'DoctorRateController@restoreTrashed');
});
/*--------------Social Media Route-------*/
Route::group(['prefix'=>'SocialMedia','namespace'=>'SocialMedia'],function () {
    Route::get('/get', 'SocialMediaController@get');
    Route::get('/getById/{id}', 'SocialMediaController@getById');
    Route::get('/getTrashed', 'SocialMediaController@getTrashed');
    Route::post('/create', 'SocialMediaController@create');
    Route::put('/update/{id}', 'SocialMediaController@update');
    Route::PUT('/trash/{id}', 'SocialMediaController@trash');
    Route::delete('/delete/{id}', 'SocialMediaController@delete');
    Route::PUT('/restoreTrashed/{id}', 'SocialMediaController@restoreTrashed');
});
///*------------Hospital Route------------*/
Route::group(['prefix'=>'Hospital','namespace'=>'Hospital'],function () {
    Route::get('/get', 'HospitalController@get');
    Route::get('/getById/{id}', 'HospitalController@getById');
    Route::get('/getTrashed', 'HospitalController@getTrashed');
    Route::post('/create', 'HospitalController@create');
    Route::put('/update/{id}', 'HospitalController@update');
    Route::GET('/search/{name}', 'HospitalController@search');
    Route::PUT('/trash/{id}', 'HospitalController@trash');
    Route::delete('/delete/{id}', 'HospitalController@delete');
    Route::PUT('/restoreTrashed/{id}', 'HospitalController@restoreTrashed');


    Route::GET('/doctor-work-in-this-hospital/{hospital_name}', 'HospitalController@hospitalsDoctor');
});

///*---------------Clinic Route-------------*/
Route::group(['prefix'=>'clinic','namespace'=>'Clinic'],function () {
    Route::get('/get',          'ClinicController@get');
    Route::get('/getById/{id}', 'ClinicController@getById');
    Route::get('/getTrashed',   'ClinicController@getTrashed');
    Route::post('/create',      'ClinicController@create');
    Route::put('/update/{id}',  'ClinicController@update');
    Route::GET('/search/{name}','ClinicController@search');
    Route::PUT('/trash/{id}',   'ClinicController@trash');
    Route::delete('/delete/{id}','ClinicController@delete');
    Route::PUT('/restoreTrashed/{id}', 'ClinicController@restoreTrashed');
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
Route::group(['prefix'=>'MedicalDevice','namespace'=>'MedicalDevice'],function () {
    Route::get('/get', 'MedicalDeviceController@get');
    Route::get('/getById/{id}', 'MedicalDeviceController@getById');
    Route::get('/getTrashed', 'MedicalDeviceController@getTrashed');
    Route::post('/create', 'MedicalDeviceController@create');

    Route::put('/update/{id}', 'MedicalDeviceController@update');
    Route::GET('/search/{name}', 'MedicalDeviceController@search');
    Route::PUT('/trash/{id}', 'MedicalDeviceController@trash');
    Route::delete('/delete/{id}', 'MedicalDeviceController@delete');
    Route::PUT('/restoreTrashed/{id}', 'MedicalDeviceController@restoreTrashed');
});
/*---------------Specialty Route-------------*/
Route::group(['prefix'=>'Specialty','namespace'=>'Specialty'],function () {
    Route::get('/get', 'SpecialtyController@get');
    Route::get('/getById/{id}', 'SpecialtyController@getById');
    Route::get('/getTrashed', 'SpecialtyController@getTrashed');
    Route::post('/create', 'SpecialtyController@create');
    Route::put('/update/{id}', 'SpecialtyController@update');
    Route::GET('/search/{name}', 'SpecialtyController@search');
    Route::PUT('/trash/{id}', 'SpecialtyController@trash');
    Route::delete('/delete/{id}', 'SpecialtyController@delete');
    Route::PUT('/restoreTrashed/{id}', 'SpecialtyController@restoreTrashed');
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
Route::group(['prefix'=>'Appointment','namespace'=>'Appointment'],function () {
    Route::get('/get', 'AppointmentController@get');
    Route::get('/getById/{id}', 'AppointmentController@getById');
    Route::get('/getTrashed', 'AppointmentController@getTrashed');
    Route::post('/create', 'AppointmentController@create');
    Route::put('/update/{id}', 'AppointmentController@update');
    Route::PUT('/trash/{id}', 'AppointmentController@trash');
    Route::delete('/delete/{id}', 'AppointmentController@delete');
    Route::PUT('/restoreTrashed/{id}', 'AppointmentController@restoreTrashed');
});
///*---------------Customer Route-------------*/
Route::group(['prefix'=>'customer','namespace'=>'Customer'],function () {
    Route::get('/get',          'CustomerController@get');
    Route::get('/getById/{id}', 'CustomerController@getById');
    Route::get('/getTrashed',   'CustomerController@getTrashed');
    Route::post('/create',      'CustomerController@create');
    Route::put('/update/{id}',  'CustomerController@update');
    Route::GET('/search/{name}','CustomerController@search');
    Route::PUT('/trash/{id}',   'CustomerController@trash');
    Route::delete('/delete/{id}','CustomerController@delete');
    Route::PUT('/restoreTrashed/{id}', 'CustomerController@restoreTrashed');
});
///*---------------Medical File Route-------------*/
Route::group(['prefix'=>'MedicalFile','namespace'=>'MedicalFile'],function () {
    Route::get('/get', 'MedicalFileController@get');
    Route::get('/getById/{id}', 'MedicalFileController@getById');
    Route::get('/getTrashed', 'MedicalFileController@getTrashed');
    Route::post('/create', 'MedicalFileController@create');
    Route::put('/update/{id}', 'MedicalFileController@update');
    Route::PUT('/trash/{id}', 'MedicalFileController@trash');
    Route::delete('/delete/{id}', 'MedicalFileController@delete');
    Route::PUT('/restoreTrashed/{id}', 'MedicalFileController@restoreTrashed');
});

///*---------------Active Time Route-------------*/
Route::group(['prefix'=>'ActiveTime','namespace'=>'ActiveTime'],function () {
    Route::get('/get', 'ActiveTimeController@get');
    Route::get('/getById/{id}', 'ActiveTimeController@getById');
    Route::get('/getTrashed', 'ActiveTimeController@getTrashed');
    Route::post('/create', 'ActiveTimeController@create');
    Route::put('/update/{id}', 'ActiveTimeController@update');
    Route::PUT('/trash/{id}', 'ActiveTimeController@trash');
    Route::delete('/delete/{id}', 'ActiveTimeController@delete');
    Route::PUT('/restoreTrashed/{id}', 'ActiveTimeController@restoreTrashed');
});
