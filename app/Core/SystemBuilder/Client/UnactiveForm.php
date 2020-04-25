<?php


namespace App\Core\SystemBuilder\Client;

use App\Core\SystemBuilder\FormBuilder;

class UnactiveForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'unactiveClients'];

    protected $fields =[

        'name' => 'Inactivos',
        'key' => 'unactiveClients',
        'target' => 'panel/unactive-clients',
        'icon' => 'fa fa-trash',
        'state' => '1',
    ];


}
