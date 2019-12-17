<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InPrepareStateOrder extends StateHanddler implements OrderStateInterface
{

    public $state = [];
    public $stateId;
    public $nextState;


    public function __construct( Request $request, $order = null )
    {
        parent::__construct();
        $this->request = $request;
        $this->orderObject = $order;
        $this->stateId = 4;
        $this->nextState = 5;
    }

    function edit()
    {
        $this->state['title'] = 'Orden en preparación.';
        $this->state['order'] = $this->orderObject;
        $this->state['formAccessor'] = 'inPrepareOrder';
        $this->state['rejectRoute'] = false;
        $this->state['routeBack'] = 'backend.inprepare.orders';
        $this->state['forwardButton'] = 'Entregar';
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
                'message' => 'La orden '. $this->orderObject->fullIdentifier .' ha sido entregada.',
                'redirection' => route('backend.inprepare.orders'),
                'status' => true,
            ];
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            $this->state = [
                'message' => 'La orden '. $this->orderObject->fullIdentifier .' no pudo ser actualizada.',
                'redirection' => 'backend.inprepare.orders',
                'status' => false,
            ];

        }
        return $this->returnState();
    }

    function index()
    {
        $this->state['orders'] = SaleOrder::where('state_id', $this->stateId)->get();
        $this->state['formAccessor'] = 'inPrepareOrders';
        $this->state['title'] = 'Ordenes en preparación';
        $this->state['route'] = $this->editionRoute;



        return $this->returnState();
    }

    public function returnState(){
        return $this->state;
    }
}
