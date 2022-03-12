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
Route::post('auth/login', 'ApiController@login');
Route::post('auth/register', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('auth/logout', 'ApiController@logout');

    Route::group(['middleware' => 'admin'], function () {
      Route::apiResource('attributes', 'AttributeController');
      Route::apiResource('statuses', 'StatusController');
      Route::apiResource('entities', 'EntityController');

      Route::get('category/add', 'AttributeController@index');
      Route::post('category/store', 'EntityController@storeCategory');
    });

    Route::apiResource('auth/users', 'UserController');
    /* Apiresource included routes */
    // Route::get('entities', 'EntityController@index');
    // Route::get('entities/{id}', 'EntityController@show');
    // Route::post('entities', 'EntityController@store');
    // Route::put('entities/{id}', 'EntityController@update');
    // Route::delete('entities/{id}', 'EntityController@destroy');

    Route::put('entity/{id}', 'EntityController@updateEntity');

    Route::get('item/{categoryid}/add', 'EntityController@getActiveItems');
    Route::post('item/{categoryid}/store', 'EntityController@storeItem');
});

Route::get('categories/search', 'EntityController@getActiveCategories');
Route::get('items/{categoryid}/search', 'EntityController@getActiveItems');
Route::get('{entity}/{id}', 'EntityController@getActiveEntity');

Route::get('auth/{provider}', 'ApiController@redirectToProvider');
Route::get('auth/{provider}/callback', 'ApiController@handleProviderCallback');
