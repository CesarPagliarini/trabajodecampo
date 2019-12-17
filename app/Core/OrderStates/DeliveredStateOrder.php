<?php


namespace App\Core\OrderStates;



use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;

class DeliveredStateOrder extends StateHanddler implements OrderStateInterface
{

    public $state = [];
    public $stateId;
    public $nextState;


    public function __construct( Request $request, $order = null )
    {
        parent::__construct();
        $this->request = $request;
        $this->orderObject = $order;
        $this->stateId = 5;
        $this->nextState = 5;
    }

    function edit()
    {
        $this->state['title'] = 'Orden entregada.';
        $this->state['order'] = $this->orderObject;
        $this->state['formAccessor'] = 'deliveredOrder';
        $this->state['rejectRoute'] = false;
        $this->state['routeBack'] = 'backend.delivered.orders';
        $this->state['forwardButton'] = 'Entregar';
        $this->state['canUpdate'] = false;

        return $this->returnState();
    }

    function update()
    {

    }

    function index()
    {
        $this->state['orders'] = SaleOrder::where('state_id', $this->stateId)->get();
        $this->state['formAccessor'] = 'inPrepareOrders';
        $this->state['title'] = 'Ordenes en preparación';
        $this->state['route'] = $this->editionRoute;

        return $this->returnState();
    }

    function returnState()
    {
        return $this->state;
    }
}
