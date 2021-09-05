<?php

use App\Http\Controllers\ActiveTime\ActiveTimeController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Clinic\ClinicController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\DoctorRate\DoctorRateController;
use App\Http\Controllers\Doctors\DoctorController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\Interaction\InteractionController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\MedicalDevice\MedicalDeviceController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\RestaurantCategory\RestaurantCategoyrController;
use App\Http\Controllers\RestaurantProduct\RestaurantProductController;
use App\Http\Controllers\RestaurantType\RestaurantTypeController;
use App\Http\Controllers\SocialMedia\SocialMediaController;
use App\Http\Controllers\Specialty\SpecialtyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
          Route::group(['prefix'=>'doctors','namespace'=>'Doctors'],function ()
                {
                Route::get('/', 'DoctorController@get');
                Route::get('/{id}', 'DoctorController@getById');
                Route::post('/create', 'DoctorController@create');
                Route::put('/{id}', 'DoctorController@update');
                Route::GET('/search/{name}', 'DoctorController@search');
                Route::PUT('/trash/{id}', 'DoctorController@trash');
                Route::delete('/{id}', 'DoctorController@delete');
                Route::PUT('/restoretrashed/{id}', 'DoctorController@restoreTrashed');

                // Route::GET('/doctor-social-media/{doctor_id}', 'DoctorController@DoctorSocialMedia');
                Route::GET('/doctor-medical-device/{doctor_id}', 'DoctorController@doctormedicaldevice');
                Route::GET('/hospital-doctor/{doctor_id}', 'DoctorController@doctorhospital');
                Route::GET('/appointment-doctor/{doctor_id}', 'DoctorController@doctorappointment');
                Route::GET('/clinic-doctor/{doctor_id}', 'DoctorController@doctorclinic');
                Route::get('/view-Patient/{doctor_id}','DoctorController@Patient');
                Route::get('/doctor-rate/{doctor_id}','DoctorController@DoctorRate');
                Route::get('/doctor-specialty/{doctor_id}','DoctorController@DoctorSpecialty');

                //____ insert 
                Route::post('/hospital','DoctorController@InsertDoctorHospital');
                Route::post('/medical-device','DoctorController@InsertDoctorMedicalDevice');
                Route::Post('/specialty','DoctorController@InsertDoctorSpecialty');
                Route::Post('/patient','DoctorController@InsertDoctorPatient');

            });
                Route::get('doctor/gettrashed', [DoctorController::class,'getTrashed']);

             /*-------------Patient Route------------------*/
         Route::group(['prefix'=>'patients','namespace'=>'Patient'],function ()
          {
               Route::get('/','PatientController@getAll');
               Route::get('/{id}','PatientController@getById');
               Route::post('/', 'PatientController@create');
               Route::put('/{id}', 'PatientController@update');
               Route::PUT('/trash/{id}', 'PatientController@trash');
               Route::delete('/{id}', 'PatientController@delete');
               Route::PUT('/restoretrashed/{id}', 'PatientController@restoreTrashed');
            });
              Route::get('patient/gettrashed', [PatientController::class,'getTrashed']);

                /*---------------Doctor Rate Route--------*/
            Route::group(['prefix'=>'doctorrates','namespace'=>'DoctorRate'],function ()
            {
                Route::get('/', 'DoctorRateController@get');
                Route::get('/{id}', 'DoctorRateController@getById');
                Route::post('/', 'DoctorRateController@create');
                Route::put('/{id}', 'DoctorRateController@update');
                Route::PUT('/trash/{id}', 'DoctorRateController@trash');
                Route::delete('/{id}', 'DoctorRateController@delete');
                Route::PUT('/restoretrashed/{id}', 'DoctorRateController@restoreTrashed');
            });
                Route::get('doctorrate/gettrashed', [DoctorRateController::class,'getTrashed']);

               /*--------------Social Media Route-------*/
            Route::group(['prefix'=>'socialmedia','namespace'=>'SocialMedia'],function ()
             {
                Route::get('/', 'SocialMediaController@get');
                Route::get('/{id}', 'SocialMediaController@getById');
                Route::post('/', 'SocialMediaController@create');
                Route::put('/{id}', 'SocialMediaController@update');
                Route::PUT('/trash/{id}', 'SocialMediaController@trash');
                Route::delete('/{id}', 'SocialMediaController@delete');
                Route::PUT('/restoretrashed/{id}', 'SocialMediaController@restoreTrashed');
           });
                Route::get('media/gettrashed', [SocialMediaController::class,'getTrashed']);


             /*------------Hospital Route------------*/
           Route::group(['prefix'=>'hospitals','namespace'=>'Hospital'],function ()
            {
                Route::get('/', 'HospitalController@get');
                Route::get('/{id}', 'HospitalController@getById');
                Route::post('/', 'HospitalController@create');
                Route::put('/{id}', 'HospitalController@update');
                Route::GET('search/{name}', 'HospitalController@search');
                Route::PUT('/trash/{id}', 'HospitalController@trash');
                Route::delete('/{id}', 'HospitalController@delete');
                Route::PUT('/restoretrashed/{id}', 'HospitalController@restoreTrashed');
                Route::GET('/doctor-work-in-this-hospital/{id}', 'HospitalController@hospitalsDoctor');
            });
                Route::get('hospital/gettrashed', [HospitalController::class,'getTrashed']);


             /*---------------Clinic Route-------------*/
         Route::group(['prefix'=>'clinics','namespace'=>'Clinic'],function ()
               {
                Route::get('/',          'ClinicController@get');
                Route::get('/{id}', 'ClinicController@getById');
                Route::post('/',      'ClinicController@create');
                Route::put('/{id}',  'ClinicController@update');
                Route::GET('/search/{name}','ClinicController@search');
                Route::PUT('/trash/{id}',   'ClinicController@trash');
                Route::delete('/{id}','ClinicController@delete');
                Route::PUT('/restoretrashed/{id}', 'ClinicController@restoreTrashed');
               });
                   Route::get('clinic/gettrashed',   [ClinicController::class,'getTrashed']);
                /*---------------Medical Device Route-------------*/
                Route::group(['prefix'=>'medicaldevices','namespace'=>'MedicalDevice'],function ()
                {
                Route::get('/', 'MedicalDeviceController@get');
                Route::get('/{id}', 'MedicalDeviceController@getById');
                Route::post('/', 'MedicalDeviceController@create');
                Route::put('/{id}', 'MedicalDeviceController@update');
                Route::GET('/search/{name}', 'MedicalDeviceController@search');
                Route::PUT('/trash/{id}', 'MedicalDeviceController@trash');
                Route::delete('/{id}', 'MedicalDeviceController@delete');
                Route::PUT('/restoretrashed/{id}', 'MedicalDeviceController@restoreTrashed');
                Route::GET('/get-doctor-by-medical-device/{id}','MedicalDeviceController@getdoctor');
               });
                 Route::get('medicaldevice/gettrashed', [MedicalDeviceController::class,'getTrashed']);

                 /*---------------Specialty Route-------------*/
         Route::group(['prefix'=>'specialties','namespace'=>'Specialty'],function ()
                {
                Route::get('/', 'SpecialtyController@get');
                Route::get('/{id}', 'SpecialtyController@getById');
                Route::post('/', 'SpecialtyController@create');
                Route::put('/{id}', 'SpecialtyController@update');
                Route::GET('/search/{name}', 'SpecialtyController@search');
                Route::PUT('/trash/{id}', 'SpecialtyController@trash');
                Route::delete('/{id}', 'SpecialtyController@delete');
                Route::PUT('/restoretrashed/{id}', 'SpecialtyController@restoreTrashed');
                Route::get('/specialty-doctor/{speciatlty_id}', 'SpecialtyController@DoctorSpecialty');
              });
                Route::get('specialty/gettrashed', [SpecialtyController::class,'getTrashed']);

              /*--------------- Calendar Route-------------*/
         //Route::group(['prefix'=>'Calendar','namespace'=>'Calendar'],function ()
        //  {
           //    Route::get('/',          'CalendarController@get');
           //    Route::get('/{id}', 'CalendarController@getById');
           //    Route::post('/create',      'CalendarController@create');
           //    Route::put('/{id}',  'CalendarController@update');
           //    Route::PUT('/trash/{id}',   'CalendarController@trash');
           //    Route::delete('/{id}','CalendarController@delete');
           //    Route::PUT('/restoreTrashed/{id}', 'CalendarController@restoreTrashed');
           //});
              /*---------------Appointment Route-------------*/
         Route::group(['prefix'=>'appointments','namespace'=>'Appointment'],function ()
             {
                Route::get('/', 'AppointmentController@get');
                Route::get('/{id}', 'AppointmentController@getById');
                Route::post('/', 'AppointmentController@create');
                Route::put('/{id}', 'AppointmentController@update');
                Route::PUT('/trash/{id}', 'AppointmentController@trash');
                Route::delete('/{id}', 'AppointmentController@delete');
                Route::PUT('/restoretrashed/{id}', 'AppointmentController@restoreTrashed');
            });
                Route::get('appointment/gettrashed', [AppointmentController::class,'getTrashed']);

              /*---------------Active Time Route-------------*/
          Route::group(['prefix'=>'activetimes','namespace'=>'ActiveTime'],function ()
           {
                Route::get('/', 'ActiveTimeController@get');
                Route::get('/{id}', 'ActiveTimeController@getById');
                Route::post('/', 'ActiveTimeController@create');
                Route::put('/{id}', 'ActiveTimeController@update');
                Route::PUT('/trash/{id}', 'ActiveTimeController@trash');
                Route::delete('/{id}', 'ActiveTimeController@delete');
                Route::PUT('/restoretrashed/{id}', 'ActiveTimeController@restoreTrashed');
           });
                Route::get('activetime/gettrashed', [ActiveTimeController::class,'getTrashed']);


           ########################## RESTAURANT ROUTE #########################################
           /*-------------Restaurant  Manager Route------------------*/
            //  Route::group(['prefix'=>'restaurantsmangers','namespace'=>'RestaurantManager'],function ()
            //  {
            //    Route::get('/', 'RestaurantManagerController@get');
            //    Route::get('/{id}', 'RestaurantManagerController@getById');
            //    Route::GET('search/{name}','RestaurantManagerController@search');
            //    Route::post('/', 'RestaurantManagerController@create');
            //    Route::put('/{id}', 'RestaurantManagerController@update');
            //    Route::PUT('trash/{id}', 'RestaurantManagerController@trash');
            //    Route::PUT('restortrashed/{id}', 'RestaurantManagerController@restoreTrashed');
            //    Route::delete('/{id}', 'RestaurantManagerController@delete');
            // });
            // Route::get('restaurant/gettrashed', [RestaurantManagerController::class,'getTrashed']);

            /*-------------Restaurant  Route------------------*/
             Route::group(['namespace'=>'Restaurant'],function ()
              {
                Route::get('/restaurants', 'RestaurantController@get');
                Route::get('/restaurant/{id}', 'RestaurantController@getById');
                Route::get('/restaurants/gettrashed', 'RestaurantController@getTrashed');
                Route::GET('/restaurant/search/{name}','RestaurantController@search');
                Route::post('/restaurant/create', 'RestaurantController@create');
                Route::put('/restaurant/{id}', 'RestaurantController@update');
                Route::PUT('/restaurant/trash/{id}', 'RestaurantController@trash');
                Route::PUT('/restaurant/restortrashed/{id}', 'RestaurantController@restoreTrashed');
                Route::delete('/restaurant/{id}', 'RestaurantController@delete');

                Route::get('/restaurant/get-type/{restaurant_id}', 'RestaurantController@getType');
                Route::get('/restaurant/get-category/{restaurant_id}', 'RestaurantController@getCategory');
                Route::get('/restaurant/get-product/{restaurant_id}', 'RestaurantController@getProduct');
            });
                 Route::get('/restaurantsD/gettrashed', [RestaurantController::class,'getTrashed']);

             /*-------------Restaurant Type  Route------------------*/
             Route::group(['prefix'=>'restauranttypes','namespace'=>'RestaurantType'],function ()
             {
               Route::get('/', 'RestaurantTypeController@get');
               Route::get('/{id}', 'RestaurantTypeController@getById');
               Route::post('/', 'RestaurantTypeController@create');
               Route::put('/{id}', 'RestaurantTypeController@update');
               Route::GET('/search/{name}','RestaurantTypeController@search');
               Route::PUT('/trash/{id}', 'RestaurantTypeController@trash');
               Route::PUT('/restoretrashed/{id}', 'RestaurantTypeController@restoreTrashed');
               Route::delete('/{id}', 'RestaurantTypeController@delete');
               Route::get('/get-restaurant/{restaurantType_id}', 'RestaurantTypeController@getRestaurant');
            });
                Route::get('restauranttype/gettrashed', [RestaurantTypeController::class,'getTrashed']);

              /*-------------Restaurant Category Route------------------*/
           Route::group(['prefix'=>'restaurantcategories','namespace'=>'RestaurantCategory'],function ()
            {
                Route::get('/', 'RestaurantCategoyrController@get');
                Route::get('/{id}', 'RestaurantCategoyrController@getById');
                Route::post('/', 'RestaurantCategoyrController@create');
                Route::put('/{id}', 'RestaurantCategoyrController@update');
                Route::GET('/search/{name}','RestaurantCategoyrController@search');
                Route::PUT('/trash/{id}', 'RestaurantCategoyrController@trash');
                Route::PUT('/restoretrashed/{id}', 'RestaurantCategoyrController@restoreTrashed');
                Route::delete('/{id}', 'RestaurantCategoyrController@delete');
                Route::get('/get-restaurant/{restaurantCategory_id}', 'RestaurantCategoyrController@getRestaurant');
                Route::get('/get-product/{restaurantCategory_id}', 'RestaurantCategoyrController@getProduct');
           });
                Route::get('restaurantcategory/gettrashed', [RestaurantCategoyrController::class,'getTrashed']);

             /*-------------Restaurant  Product Route------------------*/
           Route::group(['prefix'=>'restaurantproducts','namespace'=>'RestaurantProduct'],function ()
            {
               Route::get('/', 'RestaurantProductController@get');
               Route::get('/{id}', 'RestaurantProductController@getById');
               Route::post('/', 'RestaurantProductController@create');
               Route::put('/{id}', 'RestaurantProductController@update');
               Route::GET('/search/{name}','RestaurantProductController@search');
               Route::PUT('/trash/{id}', 'RestaurantProductController@trash');
               Route::PUT('/restoreTrashed/{id}', 'RestaurantProductController@restoreTrashed');
               Route::delete('/{id}', 'RestaurantProductController@delete');
               Route::get('/get-restaurant/{restaurantproduct_id}', 'RestaurantProductController@getRestaurant');
               Route::get('/get-category/{restaurantProduct_id}', 'RestaurantProductController@getCategory');
             });
               Route::get('restaurantproduct/gettrashed', [RestaurantProductController::class,'getTrashed']);

             /*-------------Item  Route------------------*/
            Route::group(['prefix'=>'items','namespace'=>'Item'],function ()
            {
               Route::get('/', 'ItemController@get');
               Route::get('/{id}', 'ItemController@getById');
               Route::post('/', 'ItemController@create');
               Route::put('/{id}', 'ItemController@update');
               Route::GET('/search/{name}','ItemController@search');
               Route::PUT('/trash/{id}', 'ItemController@trash');
               Route::PUT('/restoretrashed/{id}', 'ItemController@restoreTrashed');
               Route::delete('/{id}', 'ItemController@delete');
               Route::get('/get-restaurant/{item_id}', 'ItemController@getRestaurant');
               Route::get('/get-category/{item_id}', 'ItemController@getCategory');
               Route::get('/get-product/{item_id}', 'ItemController@getProduct');
            });
                Route::get('item/gettrashed', [ItemController::class,'getTrashed']);
                 Route::Post('upload','TestController@store');
               ################ OFFERS ROUTE ##################################
                //////////////// offers Route ////////////////////////////
           Route::group(['prefix'=>'offers','namespace'=>'Offer'],function ()
            {
               Route::get('/', 'OfferController@get');
               Route::get('/{id}', 'OfferController@getById');
               Route::post('/create', 'OfferController@create');
               Route::put('/{id}', 'OfferController@update');
               Route::PUT('/trash/{id}', 'OfferController@trash');
               Route::PUT('/restoretrashed/{id}', 'OfferController@restoreTrashed');
               Route::delete('/{id}', 'OfferController@delete');
               Route::get('/get-store/{Offer_id}','OfferController@getStoreByOfferId');
               Route::get('/get-offer/{store_id}','OfferController@getOfferByStoreId');
           });
                Route::get('offer/gettrashed',[OfferController::class,'getTrashed']);
                Route::get('offer/get-advertisement',[OfferController::class,'get_advertisement']);
             //////////////// Comment  Route ////////////////////////////

           Route::group(['prefix'=>'comments','namespace'=>'Comment'],function ()
           {
              Route::get('/', 'CommentController@get');
              Route::get('/{id}', 'CommentController@getById');
              Route::post('/', 'CommentController@create');
              Route::put('/{id}', 'CommentController@update');
              Route::PUT('/trash/{id}', 'CommentController@trash');
              Route::PUT('/restoretrashed/{id}', 'CommentController@restoreTrashe');
              Route::delete('/{id}', 'CommentController@delete');
              Route::get('/get_offer/{comment_id}','CommentController@getOfferByCommentId');
              Route::get('/get_comment/{offer_id}','CommentController@getcomments');
           });
               Route::get('/comment/gettrashed',[CommentController::class,'getTrashed']);

                /////////////////////// interaction Route///////////////////////////
           Route::group(['prefix'=>'interactions','namespace'=>'Interaction'],function ()
            {
                Route::get('/', 'InteractionController@get');
                Route::get('/{id}', 'InteractionController@getById');
                Route::post('/', 'InteractionController@create');
                Route::put('/{id}', 'InteractionController@update');
                Route::PUT('/trash/{id}', 'InteractionController@trash');
                Route::PUT('/restoretrashed/{id}', 'InteractionController@restoreTrashed');
                Route::delete('/{id}', 'InteractionController@delete');
           });
                 Route::get('/interaction/gettrashed',[InteractionController::class,'getTrashed']);



     Route::group(['prefix'=>'upload','namespace'=>'Images'],function ()
     {
         Route::post('category', 'CategoryImagesController@upload');
         Route::post('product', 'ProductImageController@upload');
         Route::post('brand', 'BrandImagesController@upload');
         Route::post('store', 'StoreImagesController@upload');
         Route::post('store-logo', 'StoreImagesController@uploadLogo');
         Route::post('custom-field', 'CustomFieldImagesController@upload');


     });

        });
