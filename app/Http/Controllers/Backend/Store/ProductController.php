<?php

namespace App\Http\Controllers\Backend\Store;

use App\Entities\Category;
use App\Entities\Price;
use App\Entities\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.store.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::actives();
        return view('backend.store.products.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try{
            $stmt = $request->price == '' ? $request->except('price') : $request->all();
            $product = Product::create($stmt);
            $price =   Price::create([
                'value' => $request->price,
                'currency_id' => '1',
                'product_id' => $product->id,
                'vigency_from' => Carbon::now(),
                'vigency_to' => Carbon::now()->addCenturies(1)
            ]);

            DB::commit();
            $request->session()->flash('flash_message', 'El usuario se ha creado exitosamente!');
            return redirect()->route('users.index');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $request->session()->flash('flash_error', 'El usuario no se pudo crear!');
            return redirect()->route('users.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categorias = Category::actives();

        return view('backend.store.products.edit', compact('product','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        try{
            $stmt = $request->price == '' ? $request->except('price') : $request->all();
            if($request->price != $product->price){
                  $price =   Price::create([
                    'value' => $request->price,
                    'currency_id' => '1',
                    'product_id' => $product->id,
                    'vigency_from' => Carbon::now(),
                    'vigency_to' => Carbon::now()->addCenturies(1)
                ]);
                  if($price){
                      $prices = Price::where('product_id', $product->id)->get();
                      foreach( $prices->except($price->id) as $p){
                          $p->vigency_to = Carbon::yesterday();
                          $p->save();
                      }
                  }
            }

            $product->update($stmt);

            $product->save();
            DB::commit();
            $request->session()->flash('flash_message', 'El producto se ha actualizado exitosamente!');
            return redirect()->route('products.index');

        }catch (\Exception $e){

            DB::rollBack();
            $request->session()->flash('flash_error', $e->getMessage());
            return redirect()->route('products.index');
        }
    }


}
