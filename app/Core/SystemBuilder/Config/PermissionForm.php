<?php


namespace App\Core\SystemBuilder\Config;
use App\Core\SystemBuilder\FormBuilder;

class PermissionForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'permissionsForm'];

    protected $fields =[

        'module_id' => 1,
        'name' => 'Permisos',
        'key' => 'permissionsForm',
        'target' => 'panel/permissions',
        'icon' => 'fa fa-handshake-o',
        'state' => '1',
    ];


}
