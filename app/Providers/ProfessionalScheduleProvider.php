<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProfessionalScheduleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Core\interfaces\ProfessionalScheduleRepositoryInterface',
            'App\Core\Repositories\ProfessionalScheduleRepository'
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
