<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::group(['middleware' => 'admin'], function () {
      Route::apiResource('attributes', 'AttributeController');
      Route::apiResource('statuses', 'StatusController');
      Route::apiResource('entities', 'EntityController');

      Route::get('category/add', 'AttributeController@index');
      Route::post('category/store', 'EntityController@storeCategory');
    });

    Route::apiResource('users', 'Auth\UserController');
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

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});

Route::get('categories/search', 'EntityController@getActiveCategories');
Route::get('items/{categoryid}/search', 'EntityController@getActiveItems');
Route::get('{entity}/{id}', 'EntityController@getActiveEntity');
