<?php
namespace App\Core\SystemBuilder\Orders;
use App\Core\SystemBuilder\FormBuilder;

class InPrepareForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'inPrepareOrders'];

    protected $fields =[
        'name' => 'En preparacion',
        'key' => 'inPrepareOrders',
        'target' => 'panel/in-prepare-orders',
        'icon' => 'fa fa-thumbs-o-up',
        'state' => '1',
    ];


}
