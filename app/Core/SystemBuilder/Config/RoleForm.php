<?php


namespace App\Core\SystemBuilder\Config;
use App\Core\SystemBuilder\FormBuilder;

class RoleForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'roleForm'];

    protected $fields =[

        'name' => 'Roles',
        'key' => 'roleForm',
        'target' => 'panel/roles',
        'icon' => 'fa fa-tachometer',
        'state' => '1'
    ];


}
