<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::middleware('auth:api')
    ->get('/user', function (Request $request)
{
    return $request->user();
});
Route::post('auth/login', 'Auth\AuthController@login');

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['api','ChangeLanguage',
            'localize','localizationRedirect','localeViewPath']
    ],
    function() {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('register', 'AuthController@register');
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });
//        Route::group(['middleware'=>'role:superadministrator'],function() {
        /**__________________________ Roles routes  __________________________**/
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
        /**__________________________ Permissions routes  __________________________**/
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
        /**__________________________ Users routes  __________________________**/
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
        /**__________________________ Employee routes  __________________________**/
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
        Route::group(['prefix' => 'employee', 'namespace' => 'Auth'], function () {
            Route::POST('/login', 'EmployeeAuthController@login');
        });
        /**__________________________ user type routes  __________________________**/
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
        /**______________________ Product dashboard routes  _____________________**/
        Route::group(['prefix'=>'dashproducts','namespace'=>'Product'],function()
        {
            Route::GET('/getAll','ProductsController@dashgetAll');
//            Route::GET('/getProductByCategory/{id}','ProductsController@getProductByCategory');
            Route::GET('/getById/{id}','ProductsController@dashgetById');
//            Route::POST('/create','ProductsController@create');
//            Route::PUT('/update/{id}','ProductsController@update');
//            Route::GET('/search/{title}','ProductsController@search');
//            Route::PUT('/trash/{id}','ProductsController@trash');
//            Route::PUT('/restoreTrashed/{id}','ProductsController@restoreTrashed');
//            Route::GET('/getTrashed','ProductsController@getTrashed');
//            Route::DELETE('/delete/{id}','ProductsController@delete');
        });
        /**_______________________ Store dashboard routes  ___________________**/
        Route::group(['prefix'=>'dashstores','namespace'=>'Store'],function()
        {
            Route::PUT('/aprrove/{id}','storeController@aprrove');
            Route::GET('/getAll','storeController@dashgetAll');
        });

        /**_______________________ Category dashboard routes  ___________________**/
        Route::group(['prefix'=>'dashcategories','namespace'=>'Category'],function()
        {
            Route::GET('/list','CategoriesController@list');
        });
        /**_______________________ Brand dashboard routes  ___________________**/
        Route::group(['prefix'=>'dashbrands','namespace'=>'Brand'],function()
        {
            Route::GET('/list','BrandController@list');
        });

    });

