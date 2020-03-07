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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::get('auth/google', 'ApiController@redirectToGoogle');
Route::get('auth/google/callback', 'ApiController@handleGoogleCallback');
Route::get('auth/facebook', 'ApiController@redirectToFacebook');
Route::get('auth/facebook/callback', 'ApiController@handleFacebookCallback');

Route::group(['middleware' => 'auth.jwt'], function () {
    // Route::get('logout', 'ApiController@logout');
    Route::apiResource('attributes', 'AttributeController');
    Route::apiResource('entities', 'EntityController');
    Route::apiResource('statuses', 'StatusController');
    // Route::get('attributes', 'AttributeController@index');
    // Route::get('attributes/{id}', 'AttributeController@show');
    // Route::post('attributes', 'AttributeController@store');
    // Route::put('attributes/{id}', 'AttributeController@update');
    // Route::delete('attributes/{id}', 'AttributeController@destroy');
    Route::get('item/search', 'EntityController@getCategories');
});
