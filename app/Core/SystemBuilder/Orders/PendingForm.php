<?php
namespace App\Core\SystemBuilder\Orders;
use App\Core\SystemBuilder\FormBuilder;

class PendingForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'pendingOrders'];

    protected $fields =[
        'name' => 'Pendientes',
        'key' => 'pendingOrders',
        'target' => 'panel/pending-orders',
        'icon' => 'fa fa-spinner',
        'state' => '1'
    ];


}
