<?php


namespace App\Core\OrderStates;


use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcceptedStateOrder extends StateHanddler implements OrderStateInterface
{


    public $state = [];
    public $stateId;
    public $nextState;



    public function __construct( Request $request, $order = null )
    {
        parent::__construct();
        $this->request = $request;
        $this->orderObject = $order;
        $this->stateId = 3;
        $this->nextState = 4;

    }


   public function edit()
    {
        $this->state['title'] = 'Orden aceptada.';
        $this->state['order'] = $this->orderObject;
        $this->state['formAccessor'] = 'pendingOrders';
        $this->state['rejectRoute'] = false;
        $this->state['routeBack'] = 'backend.accepted.orders';
        $this->state['forwardButton'] = 'Pasar a preparacion';
        $this->state['canUpdate'] = true;

        return $this->returnState();
    }

    function update()
    {
        try{
            DB::beginTransaction();
            $identifier = $this->orderObject->identifier;
            $this->setHistory($identifier, $this->nextState);
            $this->orderObject->update(['state_id' => $this->nextState]);

            DB::commit();
            $this->state = [
                'message' => 'La orden '. $this->orderObject->fullIdentifier .' ha sido actualizada.',
                'redirection' => route('backend.accepted.orders'),
                'status' => true,
            ];
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            $this->state = [
                'message' => 'La orden '. $this->orderObject->fullIdentifier .' no pudo ser actualizada.',
                'redirection' => 'backend.accepted.orders',
                'status' => false,
            ];

        }

        return $this->returnState();
    }

    function index()
    {
        $this->state['orders'] = SaleOrder::where('state_id', $this->stateId)->get();
        $this->state['formAccessor'] = 'acceptedOrders';
        $this->state['title'] = 'Ordenes aceptadas';
        $this->state['route'] = $this->editionRoute;

        return $this->returnState();

    }

    function returnState()
    {
       return $this->state;
    }
}
