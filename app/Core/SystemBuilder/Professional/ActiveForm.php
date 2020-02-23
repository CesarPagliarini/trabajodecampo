<?php
namespace App\Core\SystemBuilder\Professional;
use App\Core\SystemBuilder\FormBuilder;

class ActiveForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'activeProfessionalsForm'];

    protected $fields =[
        'name' => 'Activos',
        'key' => 'activeProfessionalsForm',
        'target' => 'panel/professionals',
        'icon' => 'fa fa-user',
        'state' => '1',
    ];


}
