<?php
namespace App\Core\SystemBuilder\Orders;

use App\Core\SystemBuilder\FormBuilder;

class AcceptedForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'acceptedOrders'];

    protected $fields =[
        'name' => 'Aprobados',
        'key' => 'acceptedOrders',
        'target' => 'panel/accepted-orders',
        'icon' => 'fa fa-clone',
        'state' => '1',
    ];


}
