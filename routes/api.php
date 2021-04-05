<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
                Route::POST('/getAll','ProductsController@get');
                Route::POST('/getById/{id}','ProductsController@getById');
                Route::POST('/create','ProductsController@create');
                Route::post('/update/{id}','ProductsController@update');
                Route::POST('/search/{title}','ProductsController@search');
                Route::PUT('/trash/{id}','ProductsController@trash');
                Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
                Route::POST('/getTrashed','ProductsController@getTrashed');
                Route::DELETE('/delete/{id}','ProductsController@delete');
            });
        });////////////////////end of localization//////////////////////

        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@get');
                Route::GET('/getById/{id}','CategoriesController@getById');
                Route::POST('/create','CategoriesController@create');
                Route::PUT('/update/{id}','CategoriesController@update');
                Route::PUT('/trash/{id}','CategoriesController@trash');
                Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
                Route::GET('/search/{name}','CategoriesController@search');
                Route::GET('/getTrashed','CategoriesController@getTrashed');
                Route::DELETE('/delete/{id}','CategoriesController@delete');
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
            Route::POST('/getAll','LanguageController@get');
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
        // Route::group(['prefix'=>'stores'],function ()
        //     {
        //         Route::get('/stores','Store\StoreController@getAllStore');
        //         Route::get('{id}','Store\StoreController@getStoreById');
        //         Route::post('createNewStores', 'Store\StoreController@createNewStores');
        //         Route::put('updateStore/{id}', 'Store\StoreController@updateStore');
        //         Route::put('deleteStore/{id}', 'Store\StoreController@deleteStore');
        //     });

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
                Route::POST('/getAll','ProductsController@get');
                Route::POST('/getById/{id}','ProductsController@getById');
                Route::POST('/create','ProductsController@create');
                Route::post('/update/{id}','ProductsController@update');
                Route::POST('/search/{title}','ProductsController@search');
                Route::PUT('/trash/{id}','ProductsController@trash');
                Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
                Route::POST('/getTrashed','ProductsController@getTrashed');
                Route::DELETE('/delete/{id}','ProductsController@delete');
            });
        });////////////////////end of localization//////////////////////

        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@get');
                Route::GET('/getById/{id}','CategoriesController@getById');
                Route::POST('/create','CategoriesController@create');
                Route::PUT('/update/{id}','CategoriesController@update');
                Route::PUT('/trash/{id}','CategoriesController@trash');
                Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
                Route::GET('/search/{name}','CategoriesController@search');
                Route::GET('/getTrashed','CategoriesController@getTrashed');
                Route::DELETE('/delete/{id}','CategoriesController@delete');
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
            Route::POST('/getAll','LanguageController@get');
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
        // Route::group(['prefix'=>'stores'],function ()
        //     {
        //         Route::get('/stores','Store\StoreController@getAllStore');
        //         Route::get('{id}','Store\StoreController@getStoreById');
        //         Route::post('createNewStores', 'Store\StoreController@createNewStores');
        //         Route::put('updateStore/{id}', 'Store\StoreController@updateStore');
        //         Route::put('deleteStore/{id}', 'Store\StoreController@deleteStore');
        //     });


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
                Route::GET('/getAll','ProductsController@getAll');
                Route::GET('/getById/{id}','ProductsController@getById');
                Route::POST('/create','ProductsController@create');
                Route::PUT('/update/{id}','ProductsController@update');
                Route::GET('/search/{title}','ProductsController@search');
                Route::PUT('/trash/{id}','ProductsController@trash');
                Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
                Route::GET('/getTrashed','ProductsController@getTrashed');
                Route::DELETE('/delete/{id}','ProductsController@delete');
            });
        });////////////////////end of localization//////////////////////

        /*_____________Category routes_____________*/
        Route::group(['prefix'=>'categories','namespace'=>'Category'],function()
            {
                Route::GET('/getAll','CategoriesController@getAll');
                Route::GET('/getById/{id}','CategoriesController@getById');
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
            Route::GET('/getAll','SectionsController@getAll');
            Route::GET('/getById/{id}','SectionsController@getById');
            Route::POST('/create','SectionsController@create');
            Route::PUT('/update/{id}','SectionsController@update');
            Route::PUT('/trash/{id}','SectionsController@trash');
            Route::PUT('/restoreTrashed/{id}','SectionsController@restoreTrashed');
            Route::GET('/search/{name}','SectionsController@search');
            Route::GET('/getTrashed','SectionsController@getTrashed');
            Route::DELETE('/delete/{id}','SectionsController@delete');
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


        /*_____________ Store routes_____________*/
         Route::group(['prefix'=>'stores','namespace'=>'Store'],function ()
            {
<<<<<<< HEAD

                Route::GET('/getAll','StoreController@get');

                Route::GET('/getAll','StoreController@getAll');

=======
                Route::GET('/getAll','StoreController@getAll');
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
                Route::GET('/getById/{id}','StoreController@getById');
                Route::POST('/create','StoreController@create');
                Route::PUT('/update/{id}','StoreController@update');
                Route::PUT('/trash/{id}','StoreController@trash');
                Route::PUT('/restoreTrashed/{id}','StoreController@restoreTrashed');
                Route::GET('/search/{name}','StoreController@search');
                Route::GET('/getTrashed','StoreController@getTrashed');
                Route::DELETE('/delete/{id}','StoreController@delete');

                Route::POST('/insertProductToStore','StoresProductsController@insertProductToStore');
<<<<<<< HEAD

                Route::GET('/viewStoresHasProduct/{id}','StoresProductsController@viewStoresHasProduct');



=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
                Route::PUT('/updateProductInStore/{id}','StoresProductsController@updateProductInStore');
                Route::PUT('/hiddenProductByQuantity/{id}','StoresProductsController@hiddenProductByQuantity');
                Route::GET('/viewStoresHasProduct/{id}','StoresProductsController@viewStoresHasProduct');
                Route::GET('/viewProductsInStore/{id}','StoresProductsController@viewProductsInStore');
                Route::GET('/rangeOfPrice/{id}','StoresProductsController@rangeOfPrice');
<<<<<<< HEAD


            });
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036

            });


<<<<<<< HEAD
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*_____________ Product routes _____________*/
Route::group(['middleware' =>'api','prefix'=>'products','namespace'=>'Product'],function(){
        Route::GET('/get','ProductsController@get');
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
Route::group(['middleware' =>'api','prefix'=>'categories','namespace'=>'Category'],function(){
        Route::GET('/get','CategoriesController@get');
        Route::GET('/getById/{id}','CategoriesController@getById');
        Route::POST('/create','CategoriesController@create');
        Route::PUT('/update','CategoriesController@update');
        Route::PUT('/trash/{id}','CategoriesController@trash');
        Route::PUT('/restoreTrashed/{id}','CategoriesController@restoreTrashed');
        Route::GET('/search/{name}','CategoriesController@search');
        Route::GET('/getTrashed','CategoriesController@getTrashed');
        Route::DELETE('/delete/{id}','CategoriesController@delete');
});


/*------------------Brand Routes-------------------*/
Route::group(['middleware' =>'api','prefix'=> 'brands','namespace'=>'Brand'] ,function () {
    Route::get('/get',  'BrandController@get');
    Route::get('/getById/{id}',  'BrandController@getById');
    Route::get('/getTrashed','BrandController@getTrashed');
    Route::post('/create',  'BrandController@create');
    Route::put('/update/{id}',  'BrandController@update');
    Route::GET('/search/{name}','BrandController@search');
    Route::PUT('/trash/{id}','BrandController@trash');
    Route::PUT('/restoreTrashed/{id}','BrandController@restoreTrashed');
    Route::delete('/delete{id}',  'BrandController@delete');
});

/*--------------------Language Routes----------------*/
Route::group(['middleware'=>'api','prefix'=> 'languages','namespace'=>'Language'] ,function () {
    Route::get('/get', 'LanguageController@get');
    Route::get('getById/{id}', 'LanguageController@getById');
    Route::post('/create', 'LanguageController@create');
    Route::put('/update/{id}', 'LanguageController@update');
    Route::delete('/delete/{id}', 'LanguageController@delete');
    Route::get('/getTrashed', 'LanguageController@getTrashed');
    Route::PUT('/restoreTrashed/{id}', 'LanguageController@restoreTrashed');
    Route::PUT('/trash/{id}', 'LanguageController@trash');
    Route::GET('/search/{name}', 'LanguageController@search');
});

/*----------------Store Routes---------------*/
Route::group(['middleware'=>'api','prefix'=>'stores','namespace'=>'Store'],function () {
    Route::get('/get', 'StoreController@get');
    Route::get('/getById/{id}', 'StoreController@getById');
    Route::post('/create', 'StoreController@create');
    Route::put('/update/{id}', 'StoreController@update');
    Route::delete('/delete/{id}', 'StoreController@delete');
    Route::get('/getTrashed', 'StoreController@getTrashed');
    Route::PUT('/restoreTrashed/{id}', 'StoreController@restoreTrashed');
    Route::PUT('/trash/{id}', 'StoreController@trash');
    Route::GET('/search/{name}', 'StoreController@search');
});
/*-------------Doctor Route------------------*/
Route::group(['middleware'=>'api','prefix'=>'doctor','namespace'=>'Doctors'],function () {
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
    Route::GET('/doctor-work-place/{doctor_name}', 'DoctorController@workplace');
    Route::GET('/doctor-medical-device/{doctor_name}', 'DoctorController@doctormedicaldevice');
    Route::GET('/doctor-details/{doctor_name}', 'DoctorController@getalldetails');
    Route::GET('/hospital-doctor/{doctor_name}', 'DoctorController@hospital');
    Route::GET('/appointment-doctor/{doctor_name}', 'DoctorController@appointment');


});
/*---------------Doctor Rate Route--------*/
Route::group(['middleware'=>'api','prefix'=>'DoctorRate','namespace'=>'DoctorRate'],function () {
    Route::get('/get', 'DoctorRateController@get');
    Route::get('/getById/{id}', 'DoctorRateController@getById');
//    Route::get('/getTrashed', 'DoctorRateController@getTrashed');
    Route::post('/create', 'DoctorRateController@create');
    Route::put('/update/{id}', 'DoctorRateController@update');
   // Route::PUT('/trash/{id}', 'DoctorRateController@trash');
//    Route::delete('/delete/{id}', 'DoctorRateController@delete');
//    Route::PUT('/restoreTrashed/{id}', 'DoctorRateController@restoreTrashed');


    Route::get('/get-doctor-rate','DoctorRateController@getDoctorRate');
});

/*--------------Social Media Route-------*/
Route::group(['middleware'=>'api','prefix'=>'SocialMedia','namespace'=>'SocialMedia'],function () {
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
Route::group(['middleware'=>'api','prefix'=>'Hospital','namespace'=>'Hospital'],function () {
    Route::get('/get', 'HospitalController@get');
    Route::get('/getById/{id}', 'HospitalController@getById');
    Route::get('/getTrashed', 'HospitalController@getTrashed');
    Route::post('/create', 'HospitalController@create');
    Route::put('/update/{id}', 'HospitalController@update');
    Route::GET('/search/{name}', 'HospitalController@search');
    Route::PUT('/trash/{id}', 'HospitalController@trash');
    Route::delete('/delete/{id}', 'HospitalController@delete');
    Route::PUT('/restoreTrashed/{id}', 'HospitalController@restoreTrashed');
=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036

    Route::GET('/doctor-work-in-this-hospital/{hospital_name}', 'HospitalController@doctors');
});


<<<<<<< HEAD
///*---------------Clinic Route-------------*/
Route::group(['middleware'=>'api','prefix'=>'clinic','namespace'=>'Clinic'],function () {
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
Route::group(['middleware'=>'api','prefix'=>'MedicalDevice','namespace'=>'MedicalDevice'],function () {
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
Route::group(['middleware'=>'api','prefix'=>'Specialty','namespace'=>'Specialty'],function () {
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
///*---------------Appointment Route-------------*/
Route::group(['middleware'=>'api','prefix'=>'Appointment','namespace'=>'Appointment'],function () {
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
Route::group(['middleware'=>'api','prefix'=>'customer','namespace'=>'Customer'],function () {
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
Route::group(['middleware'=>'api','prefix'=>'MedicalFile','namespace'=>'MedicalFile'],function () {
    Route::get('/get', 'MedicalFileController@get');
    Route::get('/getById/{id}', 'MedicalFileController@getById');
    Route::get('/getTrashed', 'MedicalFileController@getTrashed');
    Route::post('/create', 'MedicalFileController@create');
    Route::put('/update/{id}', 'MedicalFileController@update');
    Route::PUT('/trash/{id}', 'MedicalFileController@trash');
    Route::delete('/delete/{id}', 'MedicalFileController@delete');
    Route::PUT('/restoreTrashed/{id}', 'MedicalFileController@restoreTrashed');
});

=======
>>>>>>> 4f040a2d1fa709b991ab336f8922d6a88477b036
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
