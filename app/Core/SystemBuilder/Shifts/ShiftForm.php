<?php
namespace App\Core\SystemBuilder\Shifts;
use App\Core\SystemBuilder\FormBuilder;

class ShiftForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'shiftForm'];

    protected $fields =[
        'name' => 'Turnos',
        'key' => 'shiftForm',
        'target' => 'panel/shifts',
        'icon' => 'fa fa-bell',
        'state' => '1',
    ];


}
