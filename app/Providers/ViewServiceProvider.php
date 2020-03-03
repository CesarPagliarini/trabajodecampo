<?php

namespace App\Providers;


use App\Entities\Form;
use App\Entities\Module;

use App\Entities\Product;
use App\Entities\Professional;
use App\Entities\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){




    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer([
            'backend.admin.modules.create',
            'backend.admin.modules.edit',
        ], function ($view) {
            $limit =  DB::table('modules')->count();
             $view->with('limit',$limit);
        });
        View::composer([
            'backend.admin.forms.create',
            'backend.admin.forms.edit',
        ], function ($view) {
            $limit =  DB::table('forms')->count();
            $view->with('limit',$limit);
        });



        if(env('APP_SITE') ==='product-store'){
        View::composer([
            'backend.home'
        ], function ($view) {
            $data = [
                'clients' =>User::allClients('active')->count(),
                'products' =>DB::table('products')->count(),
                'delivered' => DB::table('sales_order')->where('state_id',5)->count(),
                'totalOrders' => DB::table('sales_order')->count(),
            ];

            $view->with($data);
        });
        }

        if(env('APP_SITE') ==='shifts-store') {
            View::composer([
                'backend.home'
            ], function ($view) {
                $data = [
                    'clients' => User::allClients('active')->count(),
                    'professionals' => Professional::allProfessionals('active')->count(),
                    'aviable_shifts' => DB::table('schedules')->where('disponible', 1)->count(),
                    'canceled_shifts' => DB::table('schedules')->where('cancel_date','!=', null)->count(),
                ];

                $view->with($data);
            });
        }


    }
}
