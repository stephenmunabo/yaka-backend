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

Route::group(['namespace' => 'Api', 'middleware' => ['cors']], function () {
    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
    Route::get('/restaurants', 'RestaurantsController@index')->name('restaurants.index');
    Route::get('/delivery_areas', 'DeliveryAreasController@index')->name('delivery_areas.index');
    Route::get('/products', 'ProductsController@index')->name('products.index');
    Route::get('/news', 'NewsItemsController@index')->name('news.index');
    Route::post('/order', 'OrdersController@create')->name('orders.create');
    Route::post('/promo_codes/validate', 'PromoCodesController@validate_code')->name('promo_codes.validate');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/customers', 'CustomersController@create')->name('customers.create');
    Route::post('/login', 'CustomersController@login')->name('customers.login');
    Route::group(['middleware' => ['app_user_auth']], function () {
    	Route::put('/customers/1', 'CustomersController@update')->name('customers.update');
    	Route::get('/orders', 'OrdersController@index')->name('orders.index');
    });

    Route::post('/driver_login', 'DriversController@login')->name('drivers.login');
    Route::group(['middleware' => ['drivers_auth']], function () {
        Route::put('/drivers/1', 'DriversController@update')->name('drivers.update');
        Route::post('/push_token', 'DriversController@save_push_token')->name('drivers.set_push_token');
        Route::post('/order_status', 'OrdersController@setStatus')->name('drivers.set_order_status');
        Route::get('/driver_orders', 'OrdersController@indexDriver')->name('drivers.driver_index');
        Route::get('/messages', 'MessagesController@index')->name('messages.index');
        Route::post('/read_message', 'MessagesController@read')->name('messages.read');
    });
});