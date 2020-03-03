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

        Route::post('/api-attention-places', 'ShiftsFormController@aviableAttentionPlaces')->name('frontend.attention.places');
        Route::post('/api-specialties-for-attention-place', 'ShiftsFormController@aviableSpecialties')->name('frontend.specialties.for.attention.place');
        Route::post('/api-services-for-specialty', 'ShiftsFormController@aviableServices')->name('frontend.services.for.specialty');
        Route::post('/api-aviable-schedules', 'ShiftsFormController@aviableSchedules')->name('frontend.aviable.schedules');
        Route::post('/api-get-shifts', 'ShiftsFormController@getShifts')->name('frontend.get.shifts');
        Route::get('/select-shift', 'ShiftsFormController@selectShift')->name('frontend.select.shift');
        Route::post('/api-reserve-shift', 'ShiftsFormController@reserveShift')->name('frontend.reserve.shift');
    });



});






Route::middleware(['auth','checkPermissions'])->prefix('panel')->group(function () {
    require(__DIR__.'/panel.php');
});


