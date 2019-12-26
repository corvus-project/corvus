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

Route::middleware('auth:api')->get('/api', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => '/', 'as' => 'modules.api.',], function () {
    Route::get('/products', ['as' => 'products.index', 'uses' => 'ProductController@products']);
/*        Route::get('/products', ['as' => 'products.index', 'uses' => 'ProductController@index']); Route::get('/channels', ['as' => 'api.channels', 'uses' => '\Api\Controllers\DiagramController@channels']);    
    Route::get('/daily', ['as' => 'api.daily', 'uses' => '\Api\Controllers\DiagramController@daily']);         */
});