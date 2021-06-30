<?php

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
    ],
    function() {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('login', 'AuthController@login');
            Route::post('register', 'AuthController@register');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });
        Route::group(['prefix' => 'roles', 'namespace' => 'Admin'], function () {
            Route::GET('/getAll','RolesController@getAll');
            Route::GET('/getById/{id}','RolesController@getById');
            Route::POST('/create','RolesController@create');
            Route::PUT('/update/{id}','RolesController@update');
            Route::GET('/search/{title}','RolesController@search');
            Route::PUT('/trash/{id}','RolesController@trash');
            Route::PUT('/restoreTrashed/{id}','RolesController@restoreTrashed');
            Route::GET('/getTrashed','RolesController@getTrashed');
            Route::DELETE('/delete/{id}','RolesController@delete');
        });
        Route::group(['prefix' => 'permissions', 'namespace' => 'Admin'], function () {
            Route::GET('/getAll','PermissionsController@getAll');
            Route::GET('/getById/{id}','PermissionsController@getById');
            Route::POST('/create','PermissionsController@create');
            Route::PUT('/update/{id}','PermissionsController@update');
            Route::GET('/search/{title}','PermissionsController@search');
            Route::PUT('/trash/{id}','PermissionsController@trash');
            Route::PUT('/restoreTrashed/{id}','PermissionsController@restoreTrashed');
            Route::GET('/getTrashed','PermissionsController@getTrashed');
            Route::DELETE('/delete/{id}','PermissionsController@delete');
        });
    });

