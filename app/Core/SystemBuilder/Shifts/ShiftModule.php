<?php


namespace App\Core\SystemBuilder\Shifts;

use App\Core\SystemBuilder\ModuleBuilder;

class ShiftModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Turnos',
        'description' => 'Modulo de gestion de Turnos',
        'internal_handler' => 'shift_handler',
        'icon' => 'fa fa-calendar',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Turnos'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            SchedulesForm::class,
            ShiftForm::class

        ]);
    }

}
