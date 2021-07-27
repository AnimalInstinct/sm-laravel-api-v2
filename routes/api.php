<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SiteController;

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('signin', [AuthController::class, 'signin']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('signup/activate/', [AuthController::class, 'signupActivate']);
    });
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/changepassword', [UserController::class, 'changePassword']);
        Route::post('/roles/addrole', [UserController::class, 'addRole']);
        Route::post('/roles/removerole', [UserController::class, 'removeRole']);
        Route::post('/roles/userroles', [UserController::class, 'userRoles']);
        Route::post('/roles/userloggedinroles', [UserController::class, 'userLoggedInRoles']);
    });
});

Route::group([
    'prefix' => 'settings',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/users/assignrolestoall', [UserController::class, 'assignRoleToAll']);
    });
});

Route::group([
    'prefix' => 'roles',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/', 'RoleController@index');
        Route::post('/permissions/addpermission', [RoleController::class, 'addPermission']);
        Route::post('/permissions/removepermission', [RoleController::class, 'removePermission']);
        Route::post('/permissions/rolepermissions', [RoleController::class, 'rolePermissions']);
    });
});

Route::group([
    'middleware' => 'api'
], function () {
    Route::get('/profile', 'UserController@profile');
    Route::apiResources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'countries' => CountryController::class,
        'cities' => CityController::class,
        'districts' => DistrictController::class,
        'pages' => PageController::class,
        'categories' => CategoryController::class,
        'languages' => LanguageController::class,
        'translations' => TranslationController::class,
        'menus' => MenuController::class,
        'menuitems' => MenuItemController::class,
        'components' => ComponentController::class,
        'images' => ImageController::class,
        'sites' => SiteController::class,
    ]);
});

Route::group([
    'prefix' => 'components',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', [ComponentController::class, 'images']);
    });
});

Route::group([
    'prefix' => 'categories',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', [CategoryController::class, 'images']);
    });
});

Route::group([
    'prefix' => 'pages',
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('/{id}/images', [PageController::class, 'images']);
    });
});



Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', [PasswordResetController::class, 'create']);
    Route::get('find/{token}', [PasswordResetController::class, 'find']);
    Route::post('reset', [PasswordResetController::class, 'reset']);
});
