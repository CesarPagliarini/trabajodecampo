<?php
namespace App\Core\SystemBuilder\Professional;
use App\Core\SystemBuilder\FormBuilder;

class UnactiveForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'unactiveProfessionalsForm'];


    protected $fields =[
        'name' => 'Inactivos',
        'key' => 'unactiveProfessionalsForm',
        'target' => 'panel/unactive-professionals',
        'icon' => 'fa fa-trash',
        'state' => '1',
    ];


}
