<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// use LaravelLocalization;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

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
        /*_____________ Brand routes_____________*/
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
