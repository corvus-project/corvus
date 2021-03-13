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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => '/', 'as' => 'api.admin.'], function () {
    Route::get('/customer/{id}/products', ['as' => 'customer.products', 'uses' => 'ApiController@getProductsByCustomerId']);
    Route::get('/customer', ['as' => 'customer.random', 'uses' => 'ApiController@getRandomCustomer']);
});

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api', 'prefix' => '/', 'as' => 'api.'], function () {
    Route::get('/products', ['as' => 'products.index', 'uses' => 'ProductController@index']);
    Route::get('/products/{product:sku}', ['as' => 'products.show', 'uses' => 'ProductController@show']);

    
    Route::post('/orders', ['as' => 'orders.create', 'uses' => 'OrderController@create']);
    Route::get('/orders', ['as' => 'orders.index', 'uses' => 'OrderController@index']);
    Route::get('/orders/{order:id}', ['as' => 'orders.show', 'uses' => 'OrderController@show']);
});
