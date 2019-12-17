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
Auth::routes();

Route::namespace('Frontend')->group(function(){
    Route::post('/client/register', 'ProfileController@register')->name('frontend.clients.register');
    Route::get('/', 'HomeController@index')->name('frontend.home');
    Route::get('/client/confirm-email/{token}', 'ProfileController@confirmToken')->name('frontend.clients.email.confirmation');
    Route::get('/client/thanks-for-register', 'ProfileController@registerSuccess')->name('frontend.register-success');
    Route::get('/products', 'HomeController@showProducts')->name('frontend.products');
    Route::get('/client-profile', 'ProfileController@profile')->name('frontend.client.profile')->middleware(['auth']);
});

Route::namespace('Backend\Sales')->group(function () {
    Route::post('generate-order-sale', 'SalesOrderController@generateOrderSale')->name('client.sent.order');
});


Route::get('forbidden','PanelController@forbidden')->name('forbidden');
Route::middleware(['auth','checkPermissions'])->prefix('panel')->group(function () {
    Route::get('/home', 'PanelController@index')->name('panel');
    Route::post('/bulk-delete', 'PanelController@bulkDelete')->name('bulk-delete');

    Route::namespace('Backend\Admin')->group(function () {
        Route::post('synchronizePermissions','RolesController@synchronizePermissions')->name('roles.synchronize');
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::resource('forms', 'FormsController');
        Route::resource('modules', 'ModuleController');
        Route::resource('permissions', 'PermissionsController');
    });

    Route::namespace('Backend\Client')->group(function () {
        Route::get('unactive-clients', 'ClientController@unactives')->name('clients.unactives');
        Route::get('requests-clients', 'ClientController@requestClients')->name('clients.requests');
        Route::resource('clients', 'ClientController');
    });

    Route::namespace('Backend\Store')->group(function () {
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::resource('subcategories', 'SubcategoryController');
        Route::resource('brands', 'BrandController');
    });
    Route::namespace('Backend\Sales')->group(function () {
        Route::post('/reject-order', 'SalesOrderController@reject')->name('reject-order');

        Route::get('pending-orders', 'SalesOrderController@index')->name('backend.pending.orders');
        Route::get('rejected-orders', 'SalesOrderController@index')->name('backend.rejected.orders');
        Route::get('accepted-orders', 'SalesOrderController@index')->name('backend.accepted.orders');
        Route::get('delivered-orders', 'SalesOrderController@index')->name('backend.delivered.orders');
        Route::get('in-prepare-orders', 'SalesOrderController@index')->name('backend.inprepare.orders');

        Route::resource('orders', 'SalesOrderController')->only(['update', 'edit']);
    });



});


