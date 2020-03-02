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


Route::namespace('Frontend')->group(function() {
    Route::get('/', 'SiteController@index')->name('frontend.home');


    Route::namespace('Sites\ProductStore')->group(function(){
        Route::post('/client/register', 'ProfileController@register')->name('frontend.clients.register');
        Route::get('/client/confirm-email/{token}', 'ProfileController@confirmToken')->name('frontend.clients.email.confirmation');
        Route::get('/client/thanks-for-register', 'ProfileController@registerSuccess')->name('frontend.register-success');
        Route::get('/products', 'HomeController@showProducts')->name('frontend.products');
        Route::get('/client-profile', 'ProfileController@profile')->name('frontend.client.profile')->middleware(['auth']);
        Route::post('generate-order-sale', 'CartController@generateOrderSale')->name('client.sent.order');
    });

    Route::namespace('Sites\ShiftsStore')->group(function(){
        Route::get('/about-us', 'HomeController@aboutUs')->name('frontend.about.us');
        Route::get('/galery', 'HomeController@galery')->name('frontend.galery');
        Route::get('/shifts', 'HomeController@shifts')->name('frontend.shifts');
        Route::get('/profile', 'HomeController@profile')->name('frontend.profile');

        Route::post('/client-shift-register', 'ProfileController@register')->name('frontend.register');
    });



});






Route::middleware(['auth','checkPermissions'])->prefix('panel')->group(function () {
    require(__DIR__.'/panel.php');
});


