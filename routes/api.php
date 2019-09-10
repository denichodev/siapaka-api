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

