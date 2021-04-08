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
        });////////////////////end of localization//////////////////////

        /*_____________Category routes_____________*/
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

        /*_____________ Section routes_____________*/
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
                Route::GET('/getAll','StoreController@getAll');
                Route::GET('/getById/{id}','StoreController@getById');
                Route::POST('/create','StoreController@create');
                Route::PUT('/update/{id}','StoreController@update');
                Route::PUT('/trash/{id}','StoreController@trash');
                Route::PUT('/restoreTrashed/{id}','StoreController@restoreTrashed');
                Route::GET('/search/{name}','StoreController@search');
                Route::GET('/getTrashed','StoreController@getTrashed');
                Route::DELETE('/delete/{id}','StoreController@delete');

                Route::POST('/insertProductToStore','StoresProductsController@insertProductToStore');
                Route::PUT('/updateProductInStore/{id}','StoresProductsController@updateProductInStore');
                Route::PUT('/hiddenProductByQuantity/{id}','StoresProductsController@hiddenProductByQuantity');
                Route::GET('/viewStoresHasProduct/{id}','StoresProductsController@viewStoresHasProduct');
                Route::GET('/viewProductsInStore/{id}','StoresProductsController@viewProductsInStore');
                Route::GET('/rangeOfPrice/{id}','StoresProductsController@rangeOfPrice');

            });





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
