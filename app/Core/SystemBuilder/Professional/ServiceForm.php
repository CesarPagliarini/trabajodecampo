<?php
namespace App\Core\SystemBuilder\Professional;
use App\Core\SystemBuilder\FormBuilder;

class ServiceForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'serviceForm'];

    protected $fields =[
        'name' => 'Servicios',
        'key' => 'serviceForm',
        'target' => 'panel/services',
        'icon' => 'fa fa-building-o',
        'state' => '1',
    ];


}
