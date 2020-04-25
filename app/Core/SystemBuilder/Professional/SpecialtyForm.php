<?php
namespace App\Core\SystemBuilder\Professional;
use App\Core\SystemBuilder\FormBuilder;

class SpecialtyForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'specialtiesForm'];

    protected $fields =[
        'name' => 'Especialidades',
        'key' => 'specialtiesForm',
        'target' => 'panel/specialties',
        'icon' => 'fa fa-wrench',
        'state' => '1',
    ];


}
