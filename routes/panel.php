
<?php

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



    Route::namespace('Backend\Professional')->group(function () {
        Route::get('unactive-professionals', 'ProfessionalController@unactives')->name('professionals.unactives');
        Route::get('requests-professionals', 'ProfessionalController@requestClients')->name('professionals.requests');
        Route::post('update-professionals-specialties', 'ProfessionalController@updateSpecialties')->name('professionals.update-specialties');
        Route::resource('professionals', 'ProfessionalController');
        Route::group(['prefix' => 'ajax/settings'], function () {
            Route::post('professional-specialties' ,'ProfessionalSettingsController@getProfessionalSpecialties')->name('professional-settings.get.specialty.list');
            Route::post('specialty-services' ,'ProfessionalSettingsController@getSpecialtyServices')->name('professionals-settings.specialty.services');
            Route::post('attention-places' ,'ProfessionalSettingsController@getAttentionPlaces')->name('professionals-settings.get.attention.places.list');
            Route::post('currencies-list' ,'ProfessionalSettingsController@getCurrenciesList')->name('professionals-settings.get.currencies.list');
            Route::post('add-settings' ,'ProfessionalSettingsController@addSettings')->name('professionals-settings.add-settings');
            Route::post('remove-settings' ,'ProfessionalSettingsController@delete')->name('professionals-settings.remove-settings');
            Route::post('get-professional-configs' ,'ProfessionalSettingsController@professionalConfig')->name('professionals-settings.configs');
        });
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

    Route::namespace('Backend\Shift')->group(function () {
        Route::resource('shifts', 'ShiftController');
        Route::resource('schedules', 'ScheduleController');
        Route::resource('attention-places', 'AttentionPlaceController');


    });





    Route::namespace('Backend\Reports')->group(function () {
        Route::post('/reports', 'ReportController@report')->name('backend.reports');
        Route::post('/reports/single', 'ReportController@reportSingle')->name('backend.reports.single');
    });

    Route::namespace('Backend\Service')->group(function () {
        Route::resource('services', 'ServiceController');
    });
    Route::namespace('Backend\Specialty')->group(function () {
        Route::resource('specialties', 'SpecialtyController');
    });
