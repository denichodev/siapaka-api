<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** Allow OPTIONS request */
Route::options('{all:.*}', function () {
    return response()->json(null, 200);
});

Route::get('/', 'IndexController@index');

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});

// Roles
$router->get('roles', [
    'uses' => 'RoleController@index',
    'middleware' => ['auth:api'],
]);

$router->get('roles/{id}', [
    'uses' => 'RoleController@show',
    'middleware' => ['auth:api'],
]);

// Users
$router->get('users', [
    'uses' => 'UserController@index',
    'middleware' => ['auth:api', 'scopes:read-user'],
]);

$router->post('users', [
    'uses' => 'UserController@create',
    'middleware' => ['auth:api', 'scopes:write-user'],
]);

$router->post('login', [
    'uses' => 'AuthController@login',
]);

// Outlet
$router->get('outlets', [
    'uses' => 'OutletController@index',
]);

$router->get('outlets/{id}', [
    'uses' => 'OutletController@show',
]);

$router->post('outlets', [
    'uses' => 'OutletController@create',
    'middleware' => ['auth:api', 'scopes:write-outlet']
]);

$router->post('outlets/{id}', [
    'uses' => 'OutletController@update',
    'middleware' => ['auth:api', 'scopes:write-outlet']
]);

$router->delete('outlets/{id}', [
    'uses' => 'OutletController@destroy',
    'middleware' => ['auth:api', 'scopes:write-outlet']
]);

// Supplier
$router->get('suppliers', [
    'uses' => 'SupplierController@index',
    'middleware' => ['auth:api']
]);

$router->get('suppliers/{id}', [
    'uses' => 'SupplierController@show',
    'middleware' => ['auth:api']
]);

$router->post('suppliers', [
    'uses' => 'SupplierController@create',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);

$router->post('suppliers/{id}', [
    'uses' => 'SupplierController@update',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);

$router->delete('suppliers/{id}', [
    'uses' => 'SupplierController@destroy',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);

// Doctor
$router->get('doctors', [
    'uses' => 'DoctorController@index',
    'middleware' => ['auth:api']
]);

$router->get('doctors/{id}', [
    'uses' => 'DoctorController@show',
    'middleware' => ['auth:api']
]);

$router->post('doctors', [
    'uses' => 'DoctorController@create',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);

$router->post('doctors/{id}', [
    'uses' => 'DoctorController@update',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);

$router->delete('doctors/{id}', [
    'uses' => 'DoctorController@destroy',
    'middleware' => ['auth:api', 'scopes:write-supplier']
]);
