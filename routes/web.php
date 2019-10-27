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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();


Route::middleware('auth')->prefix('panel')->group(function () {
    Route::get('/', 'PanelController@index')->name('panel');
    Route::post('/bulk-delete', 'PanelController@bulkDelete')->name('bulk-delete');

    Route::namespace('Backend\Admin')->group(function () {
//        Route::post('users/bulk-delete', 'UsersController@bulkDelete')->name('bulk-delete');
//        Route::post('roles/bulk-delete', 'RolesController@bulkDelete')->name('role-bulk-delete');
        Route::post('users/update/{user}', 'UsersController@update')->name('users.update');
        Route::post('roles/update/{role}', 'RolesController@update')->name('roles.update');
        Route::resource('users', 'UsersController',['only'=> ['index','create','store','edit']]);
        Route::resource('roles', 'RolesController', ['only'=> ['index','create','store','edit']]);
        Route::resource('forms', 'FormsController');
        Route::resource('permissions', 'PermissionsController');
    });






});


