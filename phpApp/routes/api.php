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

/**
 * SUPER ADMIN ROUTES
 */
Route::group(['prefix' => '/v1', 'middleware' => ['auth:api','role:super.admin']], function () {
       Route::resource('/account', 'Api\AccountsController');
});

/**
 * STAFF ROUTES
 */
Route::group(['prefix' => '/v1', 'middleware' => ['auth:api','role:staff']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/task', 'Api\TasksController');

    Route::post('/profile/device-token', 'Api\ProfileController@storeDeviceToken');
    Route::delete('/profile/device-token/{token}', 'Api\ProfileController@destroyDeviceToken');

    Route::resource('/task.comment', 'Api\TaskCommentsController');
});



Route::group(['prefix' => '/v1/auth'], function () {
    Route::post('/login', '\App\Http\Controllers\Api\LoginController@login');
});
