<?php


namespace App\Http\Controllers\Frontend\Sites\ProductStore;


use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Entities\Product;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderDetail;
use App\Entities\SaleOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController implements ControllerContract
{
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
