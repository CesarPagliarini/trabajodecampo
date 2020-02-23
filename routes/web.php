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
    Route::post('generate-order-sale', 'CartController@generateOrderSale')->name('client.sent.order');

});




Route::middleware(['auth','checkPermissions'])->prefix('panel')->group(function () {
    require(__DIR__.'/panel.php');
});


