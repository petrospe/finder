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

Route::get('auth/{provider}', 'ApiController@redirectToProvider');
Route::get('auth/{provider}/callback', 'ApiController@handleProviderCallback');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
    Route::apiResource('attributes', 'AttributeController');
    Route::apiResource('entities', 'EntityController');
    Route::apiResource('statuses', 'StatusController');
    // Route::get('attributes', 'AttributeController@index');
    // Route::get('attributes/{id}', 'AttributeController@show');
    // Route::post('attributes', 'AttributeController@store');
    // Route::put('attributes/{id}', 'AttributeController@update');
    // Route::delete('attributes/{id}', 'AttributeController@destroy');
});

Route::get('category/add', 'AttributeController@index');
Route::post('category/store', 'EntityController@storeCategory');

// Route::put('{entity}/{id}', 'AttributeController@updateEntity');

// Route::get('item/{category}/add', 'EntityController@addItem');
// Route::post('item/{category}/store', 'EntityController@storeItem');

Route::get('categories/search', 'EntityController@getActiveCategories');
Route::get('items/{category}/search', 'EntityController@getActiveItems');
Route::get('{entity}/{id}', 'EntityController@getActiveEntity');
