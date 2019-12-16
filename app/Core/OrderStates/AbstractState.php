<?php


namespace App\Core\OrderStates;


abstract class AbstractState
{

    public $editionRoute;
    public $createRoute;
    protected $orders;
    protected $formAccessor;
    protected $title;

    public function __construct()
    {
        $this->editionRoute = 'orders.edit';
        $this->createRoute = 'orders.create';
    }



}
