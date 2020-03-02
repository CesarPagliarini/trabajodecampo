<?php

namespace App\Http\Controllers\Frontend\Sites\ShiftsStore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function aboutUs()
    {
        return view('frontend.sites.shifts-store.pages.about-us');
    }

    public function galery()
    {
        return view('frontend.sites.shifts-store.pages.galery');
    }

    public function shifts()
    {

    }
    public function profile()
    {
        return view('frontend.sites.shifts-store.pages.profile');
    }
}
