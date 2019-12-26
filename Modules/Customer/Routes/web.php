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

Route::group(['prefix' => 'admin/customers', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'verified']], function () {    
    Route::get('/', 'CustomerController@index')->name('customers.index');
    Route::get('/data', ['as' => 'customers.data', 'uses' => 'CustomerController@data']);
    Route::get('/{user}/view', ['as' => 'customers.view', 'uses' => 'CustomerController@view']);    
    Route::get('/create', ['as' => 'customers.create', 'uses' => 'CustomerController@create']);     
    Route::post('/create', ['as' => 'customers.store', 'uses' => 'CustomerController@store']);     
    Route::get('/{user}/edit', ['as' => 'customers.edit', 'uses' => 'CustomerController@edit']);     
    Route::post('/{user}/edit', ['as' => 'customers.update', 'uses' => 'CustomerController@update']);     
    
});
