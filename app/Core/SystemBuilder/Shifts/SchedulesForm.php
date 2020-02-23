<?php
namespace App\Core\SystemBuilder\Shifts;
use App\Core\SystemBuilder\FormBuilder;

class SchedulesForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'scheduleForm'];

    protected $fields =[
        'name' => 'Horarios',
        'key' => 'scheduleForm',
        'target' => 'panel/schedules',
        'icon' => 'fa fa-clock',
        'state' => '1',
    ];


}
