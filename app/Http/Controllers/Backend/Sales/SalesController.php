<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\OrderStates\AcceptedStateOrder;
use App\Core\OrderStates\DeliveredStateOrder;
use App\Core\OrderStates\InPrepareStateOrder;
use App\Core\OrderStates\PendingStateOrder;
use App\Core\OrderStates\RejectedStateOrder;
use App\Entities\Product;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderDetail;
use App\Entities\SaleOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SalesController extends  BaseController implements ControllerContract
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $path = str_replace('panel/', '', $request->path());
        switch ($path){
            case 'pending-orders':
                $data = PendingStateOrder::state()->indexState();
                break;
            case 'rejected-orders':
                $data = RejectedStateOrder::state()->indexState();
                break;
            case 'accepted-orders':
                $data = AcceptedStateOrder::state()->indexState();
                break;
            case 'in-prepare-orders':
                $data = InPrepareStateOrder::state()->indexState();
                break;
            case 'delivered-orders':
                $data = DeliveredStateOrder::state()->indexState();
                break;
            default:
                $data = false;
                break;
        }
        if($data){
            return view('backend.sales.orders.index', $data);
        }
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $respuesta = 'mal';

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
            $respuesta = 'bien';

        }catch(\Exception $e){
            $respuesta = $e->getMessage();
        }

        return response()->json($respuesta);

    }
}
