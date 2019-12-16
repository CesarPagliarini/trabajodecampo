<?php


namespace App\Core\OrderStates;


use App\Core\Entities\BaseEntity;
use App\Core\Interfaces\OrderStateInterface;
use App\Entities\SaleOrder;

class AcceptedStateOrder extends AbstractState implements OrderStateInterface
{
       public function __construct()
        {
            parent::__construct();
        }

        public static function state(){
            return new static();
        }


   public function editionState()
    {
        // TODO: Implement editionState() method.
    }

    function creationState()
    {
        // TODO: Implement creationState() method.
    }

    function indexState()
    {
        $this->orders = SaleOrder::where('state_id', 3)->get();
        $this->formAccessor = 'acceptedOrders';
        $this->title = 'Ordenes aceptadas';
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
