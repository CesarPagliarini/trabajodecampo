<?php

namespace App\Http\Controllers\Frontend\Sites\ProductStore;

use App\Core\Controllers\BaseController;
use App\Core\Entities\Token;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Product;
use Illuminate\Support\Collection;

class HomeController extends BaseController implements ControllerContract
{



    public function showProducts(){


        $products = new Collection();
        foreach (Product::all() as $product){
            $product['precio'] = $product->price;
            $products->push($product);
        }

        return view('frontend.pages.products', compact('products'));
    }
}
