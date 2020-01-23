<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 

Route::group(['prefix' => 'admin/orders', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'verified']], function () {    
    Route::get('/', 'OrderController@index')->name('orders.index');
    Route::get('/data', ['as' => 'orders.data', 'uses' => 'OrderController@data']);
    Route::get('/orders/{order}/view', ['as' => 'orders.view', 'uses' => 'OrderController@view']);    
    Route::get('/orders/{order}/update', ['as' => 'orders.update', 'uses' => 'OrderController@update']);        
});