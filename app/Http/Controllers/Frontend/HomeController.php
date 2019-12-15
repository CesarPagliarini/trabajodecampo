<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Controllers\BaseController;
use App\Core\Entities\Token;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController implements ControllerContract
{
    public function index()
    {
        return view('frontend.home');
    }

    public function showProducts(){
        $products = Product::all();
        return view('frontend.pages.products', compact('products'));
    }
}
