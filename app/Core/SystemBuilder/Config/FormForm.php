<?php


namespace App\Core\SystemBuilder\Config;
use App\Core\SystemBuilder\FormBuilder;

class FormForm extends FormBuilder
{

    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'formsForm'];

    protected $fields =[

        'name' => 'Formularios',
        'key' => 'formsForm',
        'target' => 'panel/forms',
        'icon' => 'fa fa-address-book-o',
        'state' => '1',
    ];


}
