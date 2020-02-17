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


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    Route::get('customers', 'CustomersController@all');
    Route::get('customers/{id}', 'CustomersController@get');
    Route::post('customers/new', 'CustomersController@new');

    // PRODUCTS
    Route::get('products', 'ProductController@index');
    Route::get('product/{id}', 'ProductController@show');
    Route::post('product', 'ProductController@store');
    Route::put('product', 'ProductController@store');
    Route::delete('product/{id}', 'ProductController@destroy');


    // CATEGORIES
    Route::get('categories', 'CategoryController@index');
    Route::get('category/{id}', 'CategoryController@show');
    Route::post('category', 'CategoryController@store');
    Route::put('category', 'CategoryController@store');
    Route::delete('category/{id}', 'CategoryController@destroy');    

});