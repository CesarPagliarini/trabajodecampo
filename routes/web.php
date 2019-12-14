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
    Route::get('/', 'HomeController@index');
    Route::post('/client/register', 'ProfileController@register')->name('frontend.clients.register');
    Route::get('/client/confirm-email/{token}', 'ProfileController@confirmToken')->name('frontend.clients.email.confirmation');
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

});


