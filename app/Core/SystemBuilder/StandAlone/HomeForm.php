<?php


namespace App\Core\SystemBuilder\StandAlone;



use App\Core\SystemBuilder\FormBuilder;

class HomeForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys =[
        'key' => 'homeForm',
    ];

    protected $fields =[
        'name' => 'Home',
        'key' => 'homeForm',
        'target' => 'panel/home',
        'icon' => 'fa fa-home',
        'state' => '1',

    ];

}
