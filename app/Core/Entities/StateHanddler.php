<?php


namespace App\Core\Entities;


use App\Core\OrderStates\AcceptedStateOrder;
use App\Core\OrderStates\DeliveredStateOrder;
use App\Core\OrderStates\InPrepareStateOrder;
use App\Core\OrderStates\PendingStateOrder;
use App\Core\OrderStates\RejectedStateOrder;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderHistory;
use App\Entities\StockMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

abstract class StateHanddler
{

    public $editionRoute;
    public $createRoute;
    public $orders;
    public $formAccessor;
    public $title;



    protected $request;
    protected $orderObject;

    public function __construct()
    {
        $this->editionRoute = 'orders.edit';
        $this->createRoute = 'orders.create';

    }

    public static function resolve(Request $request, String $method, SaleOrder $order = null)
    {

        $path = str_replace('panel/', '', $request->path());
        $state = $order != null ? $order->state->id : null;
        $switchable = $state != null ? $state : $path;

        switch ($switchable) {
            case 'pending-orders':
            case '1':
                return (new PendingStateOrder( $request, $order ))->$method();
                break;
            case 'rejected-orders':
            case '2':
                return (new RejectedStateOrder( $request, $order ))->$method();
                break;
            case 'accepted-orders':
            case '3':
                return (new AcceptedStateOrder( $request, $order ))->$method();
                break;
            case 'in-prepare-orders':
            case '4':
                return (new InPrepareStateOrder( $request, $order ))->$method();
                break;
            case 'delivered-orders':
            case '5':
                return (new DeliveredStateOrder( $request, $order ))->$method();
                break;
            default:
                return false;
                break;
        }
    }

    protected function moveStock($product_id, $origin, $quantity_before, $quantity_after, $order_identifier){
        try{
            DB::table('product_stock_movements')->insert([
                'product_id' => $product_id,
                'origin' => $origin,
                'quantity_before' => $quantity_before,
                'quantity_after' => $quantity_after,
                'order_identifier' => $order_identifier,
                'created_at' => Carbon::now()
            ]);
            return true;
        }catch(\Exception $e){
            return $e;
        }
    }

    protected function setHistory($identifier, $state){
        try{
            DB::table('sales_order_history')->insert([
                'order_identifier' => $identifier,
                'state_id' => $state,
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);
            return true;
        }catch(\Exception $e){
            return $e;
        }
    }
}
