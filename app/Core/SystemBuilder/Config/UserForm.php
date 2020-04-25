<?php


namespace App\Core\SystemBuilder\Config;

use App\Core\SystemBuilder\FormBuilder;

class UserForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'unactiveClients'];

    protected $fields =[
        'name' => 'Usuarios',
        'key' => 'users',
        'target' => 'panel/users',
        'icon' => 'fa fa-user-o',
    ];


}
