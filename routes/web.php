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

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'portal', 'as' => 'portal.', 'middleware' => ['web', 'auth', 'verified', 'role:vendor'], 'namespace' => 'Portal'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/account', 'AccountController@index')->name('account');

    // Cart
    Route::get('/cart/{product}/add', ['as' => 'cart.add', 'uses' => 'CartController@add']);
    Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);
    Route::post('/cart/save', ['as' => 'cart.save', 'uses' => 'CartController@save']);
    Route::post('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);

    // Products
    Route::get('/products', ['as' => 'products.index', 'uses' => 'ProductController@index']);
    Route::get('/products/data', ['as' => 'products.data', 'uses' => 'ProductController@data']);
    Route::get('/products/{product}/view', ['as' => 'products.view', 'uses' => 'ProductController@view']);
    Route::get('/products/save', ['as' => 'products.save', 'uses' => 'ProductController@save']);

    // Orders
    Route::get('/orders', ['as' => 'orders.index', 'uses' => 'OrderController@index']);
    Route::get('/orders/data', ['as' => 'orders.data', 'uses' => 'OrderController@data']);
    Route::get('/orders/{order}/view', ['as' => 'orders.view', 'uses' => 'OrderController@view']);
    Route::post('/orders/{order}/cancel', ['as' => 'orders.cancel', 'uses' => 'OrderController@cancel']);
    Route::get('/orders/upload', ['as' => 'orders.upload', 'uses' => 'OrderController@upload']);
    Route::post('/orders/upload', ['as' => 'orders.save_file', 'uses' => 'OrderController@save_file']);

});


Route::group(['as' => 'user.', 'middleware' => ['web', 'auth', 'verified']], function () {
    // Profile
    Route::get('/profile', ['as' => 'profile.form', 'uses' => 'ProfileController@form']);
    Route::post('/profile', ['as' => 'profile.save', 'uses' => 'ProfileController@save']);
});

/**
 * Backend routes
 */
Route::group(['prefix' => 'backoffice', 'as' => 'backoffice.', 'middleware' => ['web', 'auth', 'verified', 'role:administrator;orders_staff;inventory_staff'], 'namespace' => '\Corvus\Backoffice\Controllers'], function () {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Products
    Route::get('/products', ['as' => 'products.index', 'uses' => 'Catalogue\ProductController@index']);
    Route::get('/products/data', ['as' => 'products.data', 'uses' => 'Catalogue\ProductController@data']);
    Route::get('/products/{product}/view', ['as' => 'products.view', 'uses' => 'Catalogue\ProductController@view']);




    Route::get('/products/{product}/stocks', ['as' => 'products.view_stocks', 'uses' => 'Catalogue\ProductController@view_stocks']);
    Route::get('/products/{product}/categories', ['as' => 'products.view_categories', 'uses' => 'Catalogue\ProductController@view_categories']);
    Route::get('/products/{product}/history', ['as' => 'products.view_history', 'uses' => 'Catalogue\OrderController@view_history']);


    // Category CRUD
    Route::get('/products/{product}/create/categories', ['as' => 'products.create_category', 'uses' => 'Catalogue\ProductController@create_category']);
    Route::post('/products/{product}/create/categories', ['as' => 'products.create_category.store', 'uses' => 'Catalogue\ProductController@store_category']);
    Route::get('/products/{product}/delete/{category}/categories', ['as' => 'products.delete_category', 'uses' => 'Catalogue\ProductController@delete_category']);
    Route::post('/products/{product}/delete/{category}/categories', ['as' => 'products.delete_category.destroy', 'uses' => 'Catalogue\ProductController@destroy_category']);

    // Stock CRUD
    Route::get('/products/{product}/create/stocks', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.create_stock', 'uses' => 'Catalogue\ProductController@create_stock']);
    Route::post('/products/{product}/create/stocks', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.create_stock.store', 'uses' => 'Catalogue\ProductController@store_stock']);
    Route::get('/products/{product}/edit/{stock}/stocks', ['middleware' => ['role:administrator;inventory_staff'],'as' => 'products.edit_stock', 'uses' => 'Catalogue\ProductController@edit_stock']);
    Route::post('/products/{product}/edit/{stock}/stocks', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.edit_stock.update', 'uses' => 'Catalogue\ProductController@update_stock']);
    Route::get('/products/{product}/delete/{stock}/stocks', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.delete_stock', 'uses' => 'Catalogue\ProductController@delete_stock']);
    Route::post('/products/{product}/delete/{stock}/stocks', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.delete_stock.destroy', 'uses' => 'Catalogue\ProductController@destroy_stock']);

    //  PPRICING CRUD
    Route::get('/products/{product}/pricing', ['as' => 'products.view_pricing', 'uses' => 'Catalogue\PricingController@view_pricing']);
    Route::get('/products/{product}/create/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.create_pricing', 'uses' => 'Catalogue\PricingController@create_pricing']);
    Route::post('/products/{product}/create/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.create_pricing.store', 'uses' => 'Catalogue\PricingController@store_pricing']);
    Route::get('/products/{product}/edit/{pricing}/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.edit_pricing', 'uses' => 'Catalogue\PricingController@edit_pricing']);
    Route::post('/products/{product}/edit/{pricing}/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.edit_pricing.update', 'uses' => 'Catalogue\PricingController@update_pricing']);
    Route::get('/products/{product}/delete/{pricing}/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.delete_pricing', 'uses' => 'Catalogue\PricingController@delete_pricing']);
    Route::post('/products/{product}/delete/{pricing}/pricing', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'products.delete_pricing.destroy', 'uses' => 'Catalogue\PricingController@destroy_pricing']);

    // Pricing Groups
    Route::get('/pricing-groups', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.index', 'uses' => 'PricingGroupController@index']);
    Route::get('/pricing-groups/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.create', 'uses' => 'PricingGroupController@create']);
    Route::post('/pricing-groups/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.store', 'uses' => 'PricingGroupController@store']);
    Route::get('/pricing-groups/{group}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.edit', 'uses' => 'PricingGroupController@edit']);
    Route::post('/pricing-groups/{group}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.update', 'uses' => 'PricingGroupController@update']);
    Route::get('/pricing-groups/{group}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.delete', 'uses' => 'PricingGroupController@delete']);
    Route::post('/pricing-groups/{group}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'pricing_groups.destroy', 'uses' => 'PricingGroupController@destroy']);

    // Stock Type
    Route::get('/stock-groups', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.index', 'uses' => 'StockGroupController@index']);
    Route::get('/stock-groups/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.create', 'uses' => 'StockGroupController@create']);
    Route::post('/stock-groups/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.store', 'uses' => 'StockGroupController@store']);
    Route::get('/stock-groups/{stock_group}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.edit', 'uses' => 'StockGroupController@edit']);
    Route::post('/stock-groups/{stock_group}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.update', 'uses' => 'StockGroupController@update']);
    Route::get('/stock-groups/{stock_group}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.delete', 'uses' => 'StockGroupController@delete']);
    Route::post('/stock-groups/{stock_group}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'stock_groups.destroy', 'uses' => 'StockGroupController@destroy']);

    // Categories
    Route::get('/categories', ['as' => 'categories.index', 'uses' => 'Catalogue\CategoryController@index']);
    Route::get('/categories/{category}/products', ['as' => 'categories.products', 'uses' => 'Catalogue\CategoryController@products']);
    Route::get('/categories/{category}/data', ['as' => 'categories.products.data', 'uses' => 'Catalogue\CategoryController@data']);
    Route::get('/categories/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.create', 'uses' => 'Catalogue\CategoryController@create']);
    Route::post('/categories/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.store', 'uses' => 'Catalogue\CategoryController@store']);
    Route::get('/categories/{category}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.edit', 'uses' => 'Catalogue\CategoryController@edit']);
    Route::post('/categories/{category}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.update', 'uses' => 'Catalogue\CategoryController@update']);
    Route::get('/categories/{category}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.delete', 'uses' => 'Catalogue\CategoryController@delete']);
    Route::post('/categories/{category}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'categories.destroy', 'uses' => 'Catalogue\CategoryController@destroy']);

    // Warehouses
    Route::get('/warehouses', ['as' => 'warehouses.index', 'uses' => 'WarehouseController@index']);
    Route::get('/warehouses/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.create', 'uses' => 'WarehouseController@create']);
    Route::post('/warehouses/create', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.store', 'uses' => 'WarehouseController@store']);
    Route::get('/warehouses/{warehouse}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.edit', 'uses' => 'WarehouseController@edit']);
    Route::post('/warehouses/{warehouse}/edit', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.update', 'uses' => 'WarehouseController@update']);
    Route::get('/warehouses/{warehouse}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.delete', 'uses' => 'WarehouseController@delete']);
    Route::post('/warehouses/{warehouse}/delete', ['middleware' => ['role:administrator;inventory_staff'], 'as' => 'warehouses.destroy', 'uses' => 'WarehouseController@destroy']);
    Route::get('/warehouses/{warehouse}/products', ['as' => 'warehouses.products', 'uses' => 'WarehouseController@products']);
    Route::get('/warehouses/{warehouse}/products/data', ['as' => 'warehouses.products.data', 'uses' => 'WarehouseController@data']);

    // Tools
    Route::get('/tools', ['as' => 'tools.index', 'uses' => 'ToolController@index']);
    Route::get('/tools/imports', 'ImportController@index')->name('tools.import.index');
    Route::post('/tools/imports/csv_file', ['as' => 'tools.import.csv_file', 'uses' => 'ImportController@csv_file']);
    Route::get('/tools/exports', 'ExportController@index')->name('tools.export.index');
    Route::post('/tools/exports/product_list', ['as' => 'tools.exports.product_list', 'uses' => 'ExportController@product_list']);
    Route::post('/tools/exports/price_list', ['as' => 'tools.exports.price_list', 'uses' => 'ExportController@price_list']);
    Route::post('/tools/exports/order_list', ['as' => 'tools.exports.order_list', 'uses' => 'ExportController@order_list']);
    Route::post('/tools/exports/stock_list', ['as' => 'tools.exports.stock_list', 'uses' => 'ExportController@stock_list']);

    // Accounts
    Route::get('/accounts/', 'AccountController@index')->name('accounts.index');
    Route::get('/accounts/data', ['as' => 'accounts.data', 'uses' => 'AccountController@data']);
    Route::get('/accounts/{user}/view', ['as' => 'accounts.view', 'uses' => 'AccountController@view']);
    Route::get('/accounts/{user}/orders', ['middleware' => ['role:administrator'], 'as' => 'accounts.orders', 'uses' => 'AccountController@orders']);
    Route::get('/accounts/{user}/orders_data', ['middleware' => ['role:administrator'], 'as' => 'accounts.orders_data', 'uses' => 'AccountController@orders_data']);
    Route::get('/accounts/create', ['middleware' => ['role:administrator'], 'as' => 'accounts.create', 'uses' => 'AccountController@create']);
    Route::post('/accounts/create', ['middleware' => ['role:administrator'], 'as' => 'accounts.store', 'uses' => 'AccountController@store']);
    Route::get('/accounts/{user}/edit', ['middleware' => ['role:administrator'], 'as' => 'accounts.edit', 'uses' => 'AccountController@edit']);
    Route::post('/accounts/{user}/edit', ['middleware' => ['role:administrator'], 'as' => 'accounts.update', 'uses' => 'AccountController@update']);
    Route::post('/accounts/{user}/token', ['middleware' => ['role:administrator'], 'as' => 'accounts.token.regenerate', 'uses' => 'AccountController@token_regenerate']);

    // Orders
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/data', ['as' => 'orders.data', 'uses' => 'OrderController@data']);
    Route::get('/orders/{order}/view', ['as' => 'orders.view', 'uses' => 'OrderController@view']);
    Route::get('/orders/{order}/update', ['as' => 'orders.update', 'uses' => 'OrderController@update']);

    // Reports
    Route::get('/reports', 'Reports\ReportController@index')->name('reports.index');
    Route::get('/reports/warehouse/stock', ['as' => 'reports.warehouse.stock', 'uses' => 'Reports\WarehouseController@stock']);
    Route::get('/reports/warehouse/stock/data', ['as' => 'reports.warehouse.stock.data', 'uses' => 'Reports\WarehouseController@stock_data']);
    Route::get('/reports/customer/order', ['as' => 'reports.customer.order', 'uses' => 'Reports\CustomerController@orders']);
    Route::get('/reports/customer/order/data', ['as' => 'reports.customer.order.data', 'uses' => 'Reports\CustomerController@order_data']);

    // Users
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
    Route::post('/users/create', ['as' => 'users.store', 'uses' => 'UserController@store']);
    Route::get('/users/{user}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::post('/users/{user}/edit', ['as' => 'users.update', 'uses' => 'UserController@update']);

    // Settings
    Route::get('/settings', 'SettingController@form')->name('settings.form');
    Route::post('/settings', 'SettingController@update')->name('settings.form.update');
});



Route::get('/', 'HomeController@index')->name('home')->middleware(['web', 'auth']);
Route::get('/redirect', 'HomeController@redirect');

Route::get('/debug', function(){
    $locale = App::currentLocale();
    $fmt = numfmt_create( $locale, NumberFormatter::CURRENCY );
    echo numfmt_format_currency($fmt, 1234567.891234567890000, "EUR")."\n";
} );
