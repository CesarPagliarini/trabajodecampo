<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;

class PendingStateOrder extends AbstractState implements OrderStateInterface
{

    public static function state(){
        return new static();
    }


    function editionState(): Array
    {
        // TODO: Implement editionState() method.
    }

    function creationState(): Array
    {
        // TODO: Implement creationState() method.
    }

    function indexState(): Array
    {
        $this->orders = SaleOrder::where('state_id', 1)->get();
        $this->formAccessor = 'pendingOrders';
        $this->title = 'Ordenes pendientes';
        return $this->getState();
    }

    function getState()
    {
        return [
            'orders' => $this->orders,
            'formAccessor' => $this->formAccessor,
            'route' => $this->editionRoute,
            'title' => $this->title,
            'createRoute' => $this->createRoute
        ];
    }

}
