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

Route::get('forbidden','PanelController@forbidden')->name('forbidden');
Route::middleware(['auth','checkPermissions'])->prefix('panel')->group(function () {
    Route::get('/', 'PanelController@index')->name('panel');
    Route::post('/bulk-delete', 'PanelController@bulkDelete')->name('bulk-delete');
    Route::namespace('Backend\Admin')->group(function () {
        Route::post('synchronizePermissions','RolesController@synchronizePermissions')->name('roles.synchronize');
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::resource('forms', 'FormsController');
        Route::resource('modules', 'ModuleController');
        Route::resource('permissions', 'PermissionsController');



    });






});


