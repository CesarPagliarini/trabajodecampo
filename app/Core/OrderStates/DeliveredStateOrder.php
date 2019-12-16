<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;

class DeliveredStateOrder extends AbstractState implements OrderStateInterface
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
        $this->orders = SaleOrder::where('state_id', 5)->get();
        $this->formAccessor = 'deliveredOrders';
        $this->title = 'Ordenes entregadas';
        return $this->getState();
    }

    function getState()
    {
        return [
            'orders' => $this->orders,
            'formAccessor' => $this->formAccessor,
            'route' => $this->editionRoute,
            'title' => $this->title,
            'createRoute' =>$this->createRoute
        ];
    }
}
