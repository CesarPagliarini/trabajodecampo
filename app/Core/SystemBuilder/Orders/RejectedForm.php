<?php
namespace App\Core\SystemBuilder\Orders;
use App\Core\SystemBuilder\FormBuilder;

class RejectedForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'rejectedOrders'];

    protected $fields =[
        'name' => 'Rechazados',
        'key' => 'rejectedOrders',
        'target' => 'panel/rejected-orders',
        'icon' => 'fa fa-clone',
        'state' => '1',
    ];


}
