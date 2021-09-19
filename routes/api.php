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

//@define(PAGINATION_COUNT,'=','10');

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
                Route::post('upload-multi/{id}', 'ProductsController@uploadMultiple');

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
                Route::post('/upload', 'CategoriesController@upload');
                Route::post('/upload/{id}', 'CategoriesController@update_upload');

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
            Route::POST('upload', 'SectionsController@upload');
            Route::post('/upload/{id}', 'SectionsController@update_upload');
        });
        /**__________________________ customfields routes __________________________**/
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
                Route::post('/upload', 'CustomFieldsController@upload');
                Route::post('/upload/{id}', 'CustomFieldsController@update_upload');

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
                Route::post('/upload', 'BrandController@upload');
                Route::post('/upload/{id}', 'BrandController@update_upload');

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
          Route::group(['namespace'=>'Doctors'],function ()
                {
                Route::GET('/doctors', 'DoctorController@get');
                Route::GET('/doctor/{id}', 'DoctorController@getById');
                Route::post('/doctor/create', 'DoctorController@create');
                Route::put('/doctor/{id}', 'DoctorController@update');
                Route::GET('/doctor/search/{name}', 'DoctorController@search');
                Route::PUT('/doctor/trash/{id}', 'DoctorController@trash');
                Route::delete('/doctor/{id}', 'DoctorController@delete');
                Route::PUT('/doctor/restoretrashed/{id}', 'DoctorController@restoreTrashed');

                // Route::GET('/doctor-social-media/{doctor_id}', 'DoctorController@DoctorSocialMedia');
                Route::GET('/doctor/doctor-medical-device/{doctor_id}', 'DoctorController@doctormedicaldevice');
                Route::GET('/doctor/hospital-doctor/{doctor_id}', 'DoctorController@doctorhospital');
                Route::GET('/doctor/appointment-doctor/{doctor_id}', 'DoctorController@doctorappointment');
                Route::GET('/doctor/clinic-doctor/{doctor_id}', 'DoctorController@doctorclinic');
                Route::GET('/doctor/view-Patient/{doctor_id}','DoctorController@Patient');
                Route::GET('/doctor/doctor-rate/{doctor_id}','DoctorController@DoctorRate');
                Route::GET('/doctor/doctor-specialty/{doctor_id}','DoctorController@DoctorSpecialty');

                //____ insert
                Route::post('/doctor/hospital','DoctorController@InsertDoctorHospital');
                Route::post('/doctor/medical-device','DoctorController@InsertDoctorMedicalDevice');
                Route::Post('/doctor/specialty','DoctorController@InsertDoctorSpecialty');
                Route::Post('/doctor/patient','DoctorController@InsertDoctorPatient');

            });
                Route::GET('doctors/gettrashed', [DoctorController::class,'getTrashed']);

             /*-------------Patient Route------------------*/
         Route::group(['namespace'=>'Patient'],function ()
          {
               Route::GET('/patients','PatientController@getAll');
               Route::GET('/patient/{id}','PatientController@getById');
               Route::post('/patient/create', 'PatientController@create');
               Route::put('/patient/{id}', 'PatientController@update');
               Route::PUT('/patient/trash/{id}', 'PatientController@trash');
               Route::delete('/patient/{id}', 'PatientController@delete');
               Route::PUT('/patient/restoretrashed/{id}', 'PatientController@restoreTrashed');
            });
              Route::GET('patients/gettrashed', [PatientController::class,'getTrashed']);

                /*---------------Doctor Rate Route--------*/
            Route::group(['namespace'=>'DoctorRate'],function ()
            {
                Route::GET('/doctors-rate', 'DoctorRateController@get');
                Route::GET('/doctor-rate/{id}', 'DoctorRateController@getById');
                Route::post('/doctor-rate/create', 'DoctorRateController@create');
                Route::put('/doctor-rate/{id}', 'DoctorRateController@update');
                Route::PUT('/doctor-rate/trash/{id}', 'DoctorRateController@trash');
                Route::delete('/doctor-rate/{id}', 'DoctorRateController@delete');
                Route::PUT('/doctor-rate/restoretrashed/{id}', 'DoctorRateController@restoreTrashed');
            });
                Route::GET('doctors-rate/gettrashed', [DoctorRateController::class,'getTrashed']);

               /*--------------Social Media Route-------*/
            Route::group(['namespace'=>'SocialMedia'],function ()
             {
                Route::GET('/social-media', 'SocialMediaController@get');
                Route::GET('/social-media/{id}', 'SocialMediaController@getById');
                Route::post('/social-media/create', 'SocialMediaController@create');
                Route::put('/social-media/{id}', 'SocialMediaController@update');
                Route::PUT('/social-media/trash/{id}', 'SocialMediaController@trash');
                Route::delete('/social-media/{id}', 'SocialMediaController@delete');
                Route::PUT('/social-media/restoretrashed/{id}', 'SocialMediaController@restoreTrashed');
           });
                Route::GET('/socialmedia/gettrashed', [SocialMediaController::class,'getTrashed']);


             /*------------Hospital Route------------*/
           Route::group(['namespace'=>'Hospital'],function ()
            {
                Route::GET('/hospitals', 'HospitalController@get');
                Route::GET('/hospital/{id}', 'HospitalController@getById');
                Route::post('/hospital/create', 'HospitalController@create');
                Route::put('/hospital/{id}', 'HospitalController@update');
                Route::GET('/hospital/search/{name}', 'HospitalController@search');
                Route::PUT('/hospital/trash/{id}', 'HospitalController@trash');
                Route::delete('/hospital/{id}', 'HospitalController@delete');
                Route::PUT('/hospital/restoretrashed/{id}', 'HospitalController@restoreTrashed');
                Route::GET('/hospital/doctor-work-in-this-hospital/{id}', 'HospitalController@hospitalsDoctor');
            });
                Route::GET('/hospitals/gettrashed', [HospitalController::class,'getTrashed']);


             /*---------------Clinic Route-------------*/
         Route::group(['namespace'=>'Clinic'],function ()
               {
                Route::GET('/clinics', 'ClinicController@get');
                Route::GET('/clinic/{id}', 'ClinicController@getById');
                Route::post('/clinic/create',      'ClinicController@create');
                Route::put('/clinic/{id}',  'ClinicController@update');
                Route::GET('/clinic/search/{name}','ClinicController@search');
                Route::PUT('/clinic/trash/{id}',   'ClinicController@trash');
                Route::delete('/clinic/{id}','ClinicController@delete');
                Route::PUT('/clinic/restoretrashed/{id}', 'ClinicController@restoreTrashed');
               });
                   Route::GET('clinics/gettrashed',   [ClinicController::class,'getTrashed']);
                /*---------------Medical Device Route-------------*/
                Route::group(['namespace'=>'MedicalDevice'],function ()
                {
                Route::GET('/medical-devices', 'MedicalDeviceController@get');
                Route::GET('/medical-device/{id}', 'MedicalDeviceController@getById');
                Route::post('/medical-device/create', 'MedicalDeviceController@create');
                Route::put('/medical-device/{id}', 'MedicalDeviceController@update');
                Route::GET('/medical-device/search/{name}', 'MedicalDeviceController@search');
                Route::PUT('/medical-device/trash/{id}', 'MedicalDeviceController@trash');
                Route::delete('/medical-device/{id}', 'MedicalDeviceController@delete');
                Route::PUT('/medical-device/restoretrashed/{id}', 'MedicalDeviceController@restoreTrashed');
                Route::GET('/medical-device/get-doctor-by-medical-device/{id}','MedicalDeviceController@getdoctor');
               });
                 Route::GET('/medicaldevices/gettrashed', [MedicalDeviceController::class,'getTrashed']);

                 /*---------------Specialty Route-------------*/
            Route::group(['namespace'=>'Specialty'],function ()
                {
                Route::GET('/specialties', 'SpecialtyController@get');
                Route::GET('/specialty/{id}', 'SpecialtyController@getById');
                Route::post('/specialty/create', 'SpecialtyController@create');
                Route::put('/specialty/{id}', 'SpecialtyController@update');
                Route::GET('/specialty/search/{name}', 'SpecialtyController@search');
                Route::PUT('/specialty/trash/{id}', 'SpecialtyController@trash');
                Route::delete('/specialty/{id}', 'SpecialtyController@delete');
                Route::PUT('/specialty/restoretrashed/{id}', 'SpecialtyController@restoreTrashed');
                Route::get('/specialty/specialty-doctor/{speciatlty_id}', 'SpecialtyController@DoctorSpecialty');
              });
                Route::GET('specialties/gettrashed', [SpecialtyController::class,'getTrashed']);

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
         Route::group(['namespace'=>'Appointment'],function ()
             {
                Route::GET('/appointments', 'AppointmentController@get');
                Route::GET('/appointment/{id}', 'AppointmentController@getById');
                Route::post('/appointment/create', 'AppointmentController@create');
                Route::put('/appointment/{id}', 'AppointmentController@update');
                Route::PUT('/appointment/trash/{id}', 'AppointmentController@trash');
                Route::delete('/appointment/{id}', 'AppointmentController@delete');
                Route::PUT('/appointment/restoretrashed/{id}', 'AppointmentController@restoreTrashed');
            });
                Route::GET('/appointments/gettrashed', [AppointmentController::class,'getTrashed']);

              /*---------------Active Time Route-------------*/
          Route::group(['namespace'=>'ActiveTime'],function ()
           {
                Route::GET('/active-times', 'ActiveTimeController@get');
                Route::GET('/active-time/{id}', 'ActiveTimeController@getById');
                Route::post('/active-time/create', 'ActiveTimeController@create');
                Route::put('/active-time/{id}', 'ActiveTimeController@update');
                Route::PUT('/active-time/trash/{id}', 'ActiveTimeController@trash');
                Route::delete('/active-time/{id}', 'ActiveTimeController@delete');
                Route::PUT('/active-time/restoretrashed/{id}', 'ActiveTimeController@restoreTrashed');
           });
                Route::GET('/active-times/gettrashed', [ActiveTimeController::class,'getTrashed']);


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
                Route::GET('/restaurants', 'RestaurantController@get');
                Route::GET('/restaurant/{id}', 'RestaurantController@getById');
                Route::GET('/restaurant/search/{name}','RestaurantController@search');
                Route::post('/restaurant/create', 'RestaurantController@create');
                Route::put('/restaurant/{id}', 'RestaurantController@update');
                Route::PUT('/restaurant/trash/{id}', 'RestaurantController@trash');
                Route::PUT('/restaurant/restortrashed/{id}', 'RestaurantController@restoreTrashed');
                Route::delete('/restaurant/{id}', 'RestaurantController@delete');

                Route::GET('/restaurant/get-type/{restaurant_id}', 'RestaurantController@getType');
                Route::GET('/restaurant/get-category/{restaurant_id}', 'RestaurantController@getCategory');
                Route::GET('/restaurant/get-product/{restaurant_id}', 'RestaurantController@getProduct');

                 //____________insert
                 Route::post('/restaurant/product','RestaurantController@insertToRestaurantRestaurantproduct');
                 Route::post('/restaurant/item','RestaurantController@insertRestaurantitem');


            });
                 Route::GET('/restaurants/gettrashed', [RestaurantController::class,'getTrashed']);


             /*-------------Restaurant Type  Route------------------*/
             Route::group(['namespace'=>'RestaurantType'],function ()
             {
               Route::GET('/restaurants/type', 'RestaurantTypeController@get');
               Route::GET('/restaurant/type/{id}', 'RestaurantTypeController@getById');
               Route::post('/restaurant/type/create', 'RestaurantTypeController@create');
               Route::put('/restaurant/type/{id}', 'RestaurantTypeController@update');
               Route::GET('/restaurant/type/search/{name}','RestaurantTypeController@search');
               Route::PUT('/restaurant/type/trash/{id}', 'RestaurantTypeController@trash');
               Route::PUT('/restaurant/type/restoretrashed/{id}', 'RestaurantTypeController@restoreTrashed');
               Route::delete('/restaurant/type/{id}', 'RestaurantTypeController@delete');
               Route::GET('/restaurant/type/get-restaurant/{restaurantType_id}', 'RestaurantTypeController@getRestaurant');
            });
                Route::GET('/restaurant/types/gettrashed', [RestaurantTypeController::class,'getTrashed']);

              /*-------------Restaurant Category Route------------------*/
           Route::group(['namespace'=>'RestaurantCategory'],function ()
            {
                Route::GET('/restaurants/category', 'RestaurantCategoyrController@get');
                Route::GET('/restaurant/category/{id}', 'RestaurantCategoyrController@getById');
                Route::post('/restaurant/category/create', 'RestaurantCategoyrController@create');
                Route::put('/restaurant/category/{id}', 'RestaurantCategoyrController@update');
                Route::GET('/restaurant/category/search/{name}','RestaurantCategoyrController@search');
                Route::PUT('/restaurant/category/trash/{id}', 'RestaurantCategoyrController@trash');
                Route::PUT('/restaurant/category/restoretrashed/{id}', 'RestaurantCategoyrController@restoreTrashed');
                Route::delete('/restaurant/category/{id}', 'RestaurantCategoyrController@delete');
                Route::GET('/restaurant/category/get-restaurant/{restaurantCategory_id}', 'RestaurantCategoyrController@getRestaurant');
                Route::GET('/restaurant/category/get-product/{restaurantCategory_id}', 'RestaurantCategoyrController@getProduct');
                //____insert
                Route::post('/restaurant/category/restaurant/product','RestaurantCategoyrController@insertToRestaurantcategoryRestaurantproduct');
                Route::post('/restaurant/category/item','RestaurantCategoyrController@insertToRestaurantcategoryItem');
           });
                Route::GET('/restaurants/category/gettrashed', [RestaurantCategoyrController::class,'getTrashed']);

             /*-------------Restaurant  Product Route------------------*/
           Route::group(['namespace'=>'RestaurantProduct'],function ()
            {
               Route::GET('/restaurants/product', 'RestaurantProductController@get');
               Route::GET('/restaurant/product/{id}', 'RestaurantProductController@getById');
               Route::post('/restaurant/product/create', 'RestaurantProductController@create');
               Route::put('/restaurant/product/{id}', 'RestaurantProductController@update');
               Route::GET('/restaurant/product/search/{name}','RestaurantProductController@search');
               Route::PUT('/restaurant/product/trash/{id}', 'RestaurantProductController@trash');
               Route::PUT('/restaurant/product/restoreTrashed/{id}', 'RestaurantProductController@restoreTrashed');
               Route::delete('/restaurant/product/{id}', 'RestaurantProductController@delete');
               Route::GET('/restaurant/product/get-restaurant/{restaurantproduct_id}', 'RestaurantProductController@getRestaurant');
               Route::GET('/restaurant/product/get-category/{restaurantProduct_id}', 'RestaurantProductController@getCategory');
             });
               Route::GET('/restaurants/product/gettrashed', [RestaurantProductController::class,'getTrashed']);

             /*-------------Item  Route------------------*/
            Route::group(['namespace'=>'Item'],function ()
            {
               Route::get('/restaurants/item', 'ItemController@get');
               Route::get('/restaurant/item/{id}', 'ItemController@getById');
               Route::post('/restaurant/item/create', 'ItemController@create');
               Route::put('/restaurant/item/{id}', 'ItemController@update');
               Route::GET('/restaurant/item/search/{name}','ItemController@search');
               Route::PUT('/restaurant/item/trash/{id}', 'ItemController@trash');
               Route::PUT('/restaurant/item/restoretrashed/{id}', 'ItemController@restoreTrashed');
               Route::delete('/restaurant/item/{id}', 'ItemController@delete');
               Route::get('/restaurant/item/get-restaurant/{item_id}', 'ItemController@getRestaurant');
               Route::get('/restaurant/item/get-category/{item_id}', 'ItemController@getCategory');
               Route::get('/restaurant/item/get-product/{item_id}', 'ItemController@getProduct');
            });
                Route::get('/restaurants/item/gettrashed', [ItemController::class,'getTrashed']);

                 Route::Post('upload','TestController@store');
               ################ OFFERS ROUTE ##################################
                //////////////// offers Route ////////////////////////////
           Route::group(['namespace'=>'Offer'],function ()
            {
               Route::get('/offers', 'OfferController@get');
               Route::get('/offer/{id}', 'OfferController@getById');
               Route::post('/offer/create', 'OfferController@create');
               Route::put('/offer/{id}', 'OfferController@update');
               Route::PUT('/offer/trash/{id}', 'OfferController@trash');
               Route::PUT('/offer/restoretrashed/{id}', 'OfferController@restoreTrashed');
               Route::delete('/offer/{id}', 'OfferController@delete');
               Route::get('/offer/get-store/{Offer_id}','OfferController@getStoreByOfferId');
               Route::get('/offer/get-offer/{store_id}','OfferController@getOfferByStoreId');
           });
                Route::get('offers/gettrashed',[OfferController::class,'getTrashed']);
                Route::get('offer/get-advertisement',[OfferController::class,'get_advertisement']);
             //////////////// Comment  Route ////////////////////////////

           Route::group(['namespace'=>'Comment'],function ()
           {
              Route::get('/comments', 'CommentController@get');
              Route::get('/comment/{id}', 'CommentController@getById');
              Route::post('/comment/create', 'CommentController@create');
              Route::put('/comment/{id}', 'CommentController@update');
              Route::PUT('/comment/trash/{id}', 'CommentController@trash');
              Route::PUT('/comment/restoretrashed/{id}', 'CommentController@restoreTrashe');
              Route::delete('/comment/{id}', 'CommentController@delete');
              Route::get('/comment/get_offer/{comment_id}','CommentController@getOfferByCommentId');
              Route::get('/comment/get_comment/{offer_id}','CommentController@getcomments');
           });
               Route::get('/comments/gettrashed',[CommentController::class,'getTrashed']);

                /////////////////////// interaction Route///////////////////////////
           Route::group(['namespace'=>'Interaction'],function ()
            {
                Route::get('/interactions', 'InteractionController@get');
                Route::get('/interaction/{id}', 'InteractionController@getById');
                Route::post('/interaction/create', 'InteractionController@create');
                Route::put('/interaction/{id}', 'InteractionController@update');
                Route::PUT('/interaction/trash/{id}', 'InteractionController@trash');
                Route::PUT('/interaction/restoretrashed/{id}', 'InteractionController@restoreTrashed');
                Route::delete('/interaction/{id}', 'InteractionController@delete');
           });
                 Route::get('/interactions/gettrashed',[InteractionController::class,'getTrashed']);



     Route::group(['prefix'=>'upload','namespace'=>'Images'],function ()
     {
         Route::post('product/{id}', 'ProductImageController@upload');
         Route::post('store/{id}', 'StoreImagesController@upload');
         Route::post('store-logo', 'StoreImagesController@uploadLogo');
         Route::post('store-multi/{id}', 'StoreImagesController@uploadMultiple');
         Route::post('product-multi/{id}', 'ProductImageController@uploadMultiple');
         Route::post('update_uploadMultiple/{id}', 'ProductImageController@update_uploadMultiple');
     });

        });
