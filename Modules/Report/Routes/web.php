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

Route::group(['prefix' => 'admin/reports', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'verified']], function () {    
    Route::get('/', 'ReportController@index')->name('reports.index');
    Route::get('/warehouse/stock', 'WarehouseController@stock')->name('reports.warehouse.stock');
    Route::get('/warehouse/stock/data', 'WarehouseController@stock_data')->name('reports.warehouse.stock.data');
});