<?php

use Illuminate\Http\Request;
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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'Api\\JWTAuthController@register');
    Route::post('login', 'Api\\JWTAuthController@login');
    Route::post('logout', 'Api\\JWTAuthController@logout');
    Route::post('refresh', 'Api\\JWTAuthController@refresh');
    Route::get('profile', 'Api\\JWTAuthController@profile');

});
*/

//Route::get('auth/users',  'Api\\JWTAuthController@users');

/*
Route::group(['middleware' => ['apiJwt']],function(){
    Route::get('auth/users',  'Api\\JWTAuthController@users');
});
*/
/*
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', 'Api\\JWTAuthController@register');
    Route::post('login', 'Api\\JWTAuthController@login');
    Route::get('users',  'Api\\JWTAuthController@users');
});
*/

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', 'Api\\JWTAuthController@register');
    Route::post('login',    'Api\\JWTAuthController@login');
});

Route::group([
    'middleware' => ['apiJwt'],
    'prefix' => 'auth'
], function(){
    Route::post('logout',               'Api\\JWTAuthController@logout');
    Route::post('refresh',              'Api\\JWTAuthController@refresh');
    Route::get('profile',               'Api\\JWTAuthController@profile');
    Route::post('invoice',              'InvoiceController@create');
    Route::get('invoices',              'InvoiceController@invoices');
    Route::get('invoice/byUrl/{url}',   'InvoiceController@getByUrl');
    Route::get('invoice/{id}',          'InvoiceController@getById');
    Route::get('invoice/delete/{id}',   'InvoiceController@destroyById');
    Route::post('invoice/{id}',         'InvoiceController@update');
});
