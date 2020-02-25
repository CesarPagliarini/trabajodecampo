<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProfessionalSettingRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Core\interfaces\ProfessionalSettingRepositoryInterface',
            'App\Core\Repositories\ProfessionalSettingRepository'
        );


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
