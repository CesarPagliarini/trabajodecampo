<?php

namespace App\Providers;

use App\Entities\Product;
use App\Entities\Professional;
use App\Entities\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewFrontServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'frontend.sites.product-store.partials.product-slider-item',
        ], function ($view) {
            $products = Product::all();
            $view->with('products',$products);
        });



        View::composer([
            'frontend.sites.shifts-store.sliders.professionals',
        ], function ($view) {
            $professionals = Professional::frontProfessionals()->get();
            $view->with('professionals',$professionals);
        });
    }
}
