<?php


namespace App\Core\SystemBuilder\Config;
use App\Core\SystemBuilder\FormBuilder;

class ModuleForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'modulesForm'];

    protected $fields =[

        'name' => 'Modulos',
        'key' => 'modulesForm',
        'target' => 'panel/modules',
        'icon' => 'fa fa-folder-open',
        'state' => '1',
    ];


}
