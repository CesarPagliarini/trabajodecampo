<?php


namespace App\Core\OrderStates;

use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendingStateOrder extends StateHanddler implements OrderStateInterface
{

    public $state = [];
    public $stateId;
    public $nextState;


    public function __construct( Request $request, $order = null )
    {
        parent::__construct();
        $this->request = $request;
        $this->orderObject = $order;
        $this->stateId = 1;
        $this->nextState = 3;
    }


    function edit(): Array
    {
        $this->state['title'] = 'Editar orden';
        $this->state['order'] = $this->orderObject;
        $this->state['formAccessor'] = 'pendingOrders';
        $this->state['rejectRoute'] = true;
        $this->state['routeBack'] = 'backend.pending.orders';
        $this->state['forwardButton'] = 'Aceptar';

        $canAdvance = true;
        foreach($this->orderObject->details as $det){
          if( $det->product->stock < 1 || $det->product->stock < $det->quantity){
              $canAdvance = false;
          }
        };
        $this->state['canUpdate'] = $canAdvance;

        return $this->returnState();
    }

    function update(): Array
    {
        try{
            $identifier = $this->orderObject->identifier;
            foreach($this->orderObject->details as $detail){
                $prod = $detail->product;
                $before = $prod->stock;
                $dif = $prod->stock - $detail->quantity;
                $prod->update(['stock' => $dif]);
                $after = $prod->stock;

                $this->moveStock($prod->id, '1', $before, $after, $identifier);

            }
            $this->setHistory($identifier, $this->nextState);
            $this->orderObject->update(['state_id' => $this->nextState]);

            DB::commit();
            $this->state = [
              'message' => 'La orden '. $this->orderObject->fullIdentifier .' ha sido actualizada.',
              'redirection' => route('backend.pending.orders'),
              'status' => true,
            ];
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            $this->state = [
                'message' => 'La orden '. $this->orderObject->fullIdentifier .' no pudo ser actualizada.',
                'redirection' => 'backend.pending.orders',
                'status' => false,
            ];

        }

        return $this->returnState();
    }

    function index(): Array
    {

        $this->state['orders'] = SaleOrder::where('state_id', $this->stateId)->get();
        $this->state['formAccessor'] = 'rejectedOrders';
        $this->state['title'] = 'Ordenes pendientes';
        $this->state['route'] = $this->editionRoute;

        return $this->returnState();
    }

    function returnState()
    {
        return $this->state;
    }

}
