<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;

class InPrepareStateOrder extends AbstractState implements OrderStateInterface
{


    public static function state(){
        return new static();
    }


    function editionState()
    {
        // TODO: Implement editionState() method.
    }

    function creationState()
    {
        // TODO: Implement creationState() method.
    }

    function indexState()
    {
        $this->orders = SaleOrder::where('state_id', 4)->get();
        $this->formAccessor = 'inPrepareOrders';
        $this->title = 'Ordenes en preparacion';
        return $this->getState();
    }

    public function getState(){
        return [
            'orders' => $this->orders,
            'formAccessor' => $this->formAccessor,
            'route' => $this->editionRoute,
            'title' => $this->title,
            'createRoute' => $this->createRoute
        ];
    }
}
