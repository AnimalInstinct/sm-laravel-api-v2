<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('signup', 'AuthController@signup');
    Route::post('signin', 'AuthController@signin');
    Route::post('logout', 'AuthController@logout');
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('signup/activate/', 'AuthController@signupActivate');
    });
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
        Route::post('/changepassword', 'UserController@changePassword');
        Route::post('/roles/addrole', 'UserController@addRole');
        Route::post('/roles/removerole', 'UserController@removeRole');
        Route::post('/roles/userroles', 'UserController@userRoles');
        Route::post('/roles/userloggedinroles', 'UserController@userLoggedInRoles');
    });
});

Route::group([
    'prefix' => 'settings',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/users/assignrolestoall', 'UserController@assignRoleToAll');
    });
});

Route::group([
    'prefix' => 'roles',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/', 'RoleController@index');
        Route::post('/permissions/addpermission', 'RoleController@addPermission');
        Route::post('/permissions/removepermission', 'RoleController@removePermission');
        Route::post('/permissions/rolepermissions', 'RoleController@rolePermissions');
    });
});



Route::group([
    'middleware' => 'api'
], function () {
    Route::get('/profile', 'UserController@profile');
    Route::apiResources([
        'users' => 'UserController',
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
        'countries' => 'CountryController',
        'cities' => 'CityController',
        'districts' => 'DistrictController',
        'pages' => 'PageController',
        'categories' => 'CategoryController',
        'languages' => 'LanguageController',
        'translations' => 'TranslationController',
        'menus' => 'MenuController',
        'menuitems' => 'MenuItemController',
        'components' => 'ComponentController',
        'images' => 'ImageController',
        'sites' => 'SiteController',
    ]);
});

Route::group([
    'prefix' => 'components',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', 'ComponentController@images');
    });
});

Route::group([
    'prefix' => 'categories',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', 'CategoryController@images');
    });
});

Route::group([
    'prefix' => 'pages',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', 'PageController@images');
    });
});



Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});
