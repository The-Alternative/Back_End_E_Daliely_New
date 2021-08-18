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
//        Route::group(['middleware'=>'role:superadministrator'],function() {
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
//            });
        });
            Route::group(['prefix' => 'users', 'namespace' => 'Admin'], function () {
            Route::GET('/getAll','UsersController@getAll');
            Route::GET('/getById/{id}','UsersController@getById');
            Route::POST('/create','UsersController@create');
            Route::PUT('/update/{id}','UsersController@update');
            Route::GET('/search/{title}','UsersController@search');
            Route::PUT('/trash/{id}','UsersController@trash');
            Route::PUT('/restoreTrashed/{id}','UsersController@restoreTrashed');
            Route::GET('/getTrashed','UsersController@getTrashed');
            Route::DELETE('/delete/{id}','UsersController@delete');
            Route::GET('/profile/{id}','UsersController@profile');
        });
            Route::group(['prefix' => 'employee', 'namespace' => 'Admin'], function () {
            Route::GET('/getAll','EmployeesController@getAll');
            Route::GET('/getById/{id}','EmployeesController@getById');
            Route::POST('/create','EmployeesController@create');
            Route::PUT('/update/{id}','EmployeesController@update');
            Route::GET('/search/{title}','EmployeesController@search');
            Route::PUT('/trash/{id}','EmployeesController@trash');
            Route::PUT('/restoreTrashed/{id}','EmployeesController@restoreTrashed');
            Route::GET('/getTrashed','EmployeesController@getTrashed');
            Route::DELETE('/delete/{id}','EmployeesController@delete');
            Route::GET('/profile/{id}','EmployeesController@profile');
        });
            Route::group(['prefix' => 'type', 'namespace' => 'Admin'], function () {
            Route::GET('/getAll','TypeUsersController@getAll');
            Route::GET('/getById/{id}','TypeUsersController@getById');
            Route::POST('/create','TypeUsersController@create');
            Route::PUT('/update/{id}','TypeUsersController@update');
            Route::GET('/search/{title}','TypeUsersController@search');
            Route::PUT('/trash/{id}','TypeUsersController@trash');
            Route::PUT('/restoreTrashed/{id}','TypeUsersController@restoreTrashed');
            Route::GET('/getTrashed','TypeUsersController@getTrashed');
            Route::DELETE('/delete/{id}','TypeUsersController@delete');
            Route::GET('/profile/{id}','TypeUsersController@profile');
        });
    });

