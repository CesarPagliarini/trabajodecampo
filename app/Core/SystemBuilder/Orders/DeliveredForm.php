<?php
namespace App\Core\SystemBuilder\Orders;
use App\Core\SystemBuilder\FormBuilder;

class DeliveredForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'deliveredOrders'];

    protected $fields =[
        'name' => 'Entregados',
        'key' => 'deliveredOrders',
        'target' => 'panel/delivered-orders',
        'icon' => 'fa fa-thumbs-o-up',
        'state' => '1',
    ];


}
