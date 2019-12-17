<?php


namespace App\Core\ReportStrategies;


use App\Core\interfaces\ReportContract;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderState;
use Illuminate\Support\Facades\DB;

class OrderReportStrategy implements ReportContract
{
    public function forCanvas()
    {

        $orders = SaleOrderState::with('orders')->get();
        $maped  = $orders->map(function($order){
            $order['quantity'] = $order->orders->count();
            return $order->only('name','quantity');
        });


        return response()->json($maped);
    }


    public function singleElementReport($id)
    {
        return SaleOrder::find($id);
    }
}
