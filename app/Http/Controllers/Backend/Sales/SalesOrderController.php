<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Core\Controllers\BaseController;
use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\ControllerContract;


use App\Entities\Product;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderDetail;
use App\Entities\SaleOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SalesOrderController extends  BaseController implements ControllerContract
{


    public function index(Request $request)
    {
        $data = StateHanddler::resolve($request, 'index');
        return view('backend.sales.orders.index', $data);
    }

    public function edit( Request $request, SaleOrder $order)
    {
        $data = StateHanddler::resolve($request, 'edit' , $order);

        return view('backend.sales.orders.edit', $data);

    }

    public function update(Request $request, SaleOrder $order)
    {

        $data = StateHanddler::resolve($request, 'update' , $order);
        if($data['status']){
//            $request->session()->flash('flash_message', $data['message']);
            return redirect()->to($data['redirection'])->with('flash_message', $data['message']);
        }
//        $request->session()->flash('flash_error', 'La orden no se pudo actualizar');
        return redirect()->back()->with('flash_error', $data['message']);

    }


    public function reject(Request $request)
    {
        $order = SaleOrder::find($request->order_id);
        try{
            DB::beginTransaction();
            $order->update(['state_id' => 2, 'observation' => strip_tags($request->observation)]);
            SaleOrderHistory::create([
               'order_identifier' => $order->identifier,
               'state_id' => $order->state_id,
                'user_id' => Auth::user()->id
            ]);
            DB::commit();
            $response = [
                'status' => 'success',
                'error' => false,
            ];

        }catch(\Exception $e){
            $response = $e->getMessage();
        }
        return response()->json($response);

    }


    public function generateOrderSale(Request $request){
        $orden = new SaleOrder();
        $counts = SaleOrder::all();
        $identifier = count($counts)+1;
        $state_id = 1;
        $shipping_way = 1;
        $products = [];
        $subtotal = 0;
        $details = [];
        foreach($request->order as $orderItem){
            $product = Product::where('id',$orderItem['product_id'])->first();
            $subtotal += ($product->price * intval($orderItem['cantidad']));
            $detail = new SaleOrderDetail();
            $detail->fill([
                'order_identifier' => $identifier,
                'product_id' => $product->id,
                'quantity' => intval($orderItem['cantidad']),
                'unit_price' => $product->price,
                'total_item' => ($product->price * intval($orderItem['cantidad']))
            ]);
            array_push($details, $detail);
            array_push($products, $product);
        }

        $client_id = Auth::user()->id;
        $orden->fill([
            'identifier' => $identifier,
            'state_id' => $state_id,
            'shipping_way' => $shipping_way,
            'sub_total' => $subtotal,
            'client_id' => $client_id,
        ]);
        try{
            DB::beginTransaction();
                $orden->save();
                foreach($details as $filledDetail){
                    $filledDetail->save();
                }
                SaleOrderHistory::create([
                    'order_identifier' => $identifier,
                    'state_id' => $orden->state_id,
                    'user_id' => $client_id
                ]);
            DB::commit();
            $respuesta = 'success';
        }catch(\Exception $e){
            $respuesta = $e->getMessage();
        }
        return response()->json($respuesta);

    }
}
