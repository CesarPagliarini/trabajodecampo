<?php


namespace App\Http\Controllers\Frontend;


use App\Core\Controllers\BaseController;

class SiteController extends BaseController
{

    public function index()
    {

        $homeView = 'frontend.sites.'.env('APP_SITE').'.home';
        return view($homeView);
    }

}
