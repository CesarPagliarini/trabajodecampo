<?php


namespace App\Core\SystemBuilder\Orders;

use App\Core\SystemBuilder\ModuleBuilder;
use ProductForm;


class OrderModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Pedidos',
        'description' => 'Modulo de gestion de pedidos',
        'internal_handler' => 'orders_handler',
        'icon' => 'fa fa-shopping-cart',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Pedidos'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            PendingForm::class,
            AcceptedForm::class,
            InPrepareForm::class,
            RejectedForm::class,
            DeliveredForm::class

        ]);
    }

}
