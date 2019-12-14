<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Controllers\BaseController;
use App\Core\Entities\Token;
use App\Core\Interfaces\ControllerContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController implements ControllerContract
{
    public function index()
    {
        return view('frontend.home');
    }
}
