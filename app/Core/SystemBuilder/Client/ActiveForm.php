<?php
namespace App\Core\SystemBuilder\Client;

use App\Core\SystemBuilder\FormBuilder;

class ActiveForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'activeClients'];

    protected $fields =[
        'name' => 'Activos',
        'key' => 'activeClients',
        'target' => 'panel/clients',
        'icon' => 'fa fa-user',
        'state' => '1',
    ];


}
