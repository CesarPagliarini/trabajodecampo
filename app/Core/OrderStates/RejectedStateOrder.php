<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;

class RejectedStateOrder extends StateHanddler implements OrderStateInterface
{
    public $state = [];
    public $stateId;
    public $nextState;


    public function __construct( Request $request, $order = null )
    {
        parent::__construct();
        $this->request = $request;
        $this->orderObject = $order;
        $this->stateId = 2;
    }


    function edit()
    {
        $this->state['title'] = 'Orden rechazada' ;
        $this->state['order'] = $this->orderObject;
        $this->state['formAccessor'] = 'pendingOrders';
        $this->state['routeBack'] = 'backend.rejected.orders';
        $this->state['canUpdate'] = false;
        $this->state['observation'] = true;

        return $this->returnState();

    }

    function update()
    {
        // TODO: Implement creationState() method.
    }

    function index()
    {
        $this->state['orders'] = SaleOrder::where('state_id', $this->stateId)->get();
        $this->state['formAccessor'] = 'rejectedOrders';
        $this->state['title'] = 'Ordenes rechazadas';
        $this->state['route'] = $this->editionRoute;



        return $this->returnState();
    }

    public function returnState()
    {
        return $this->state;
    }
}
