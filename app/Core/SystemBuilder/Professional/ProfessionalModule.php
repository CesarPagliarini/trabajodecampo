<?php


namespace App\Core\SystemBuilder\Professional;

use App\Core\SystemBuilder\ModuleBuilder;



class ProfessionalModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Profesionales',
        'description' => 'Modulo de gestion de profesionales',
        'internal_handler' => 'professional_handler',
        'icon' => 'fa fa-vcard-o',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Profesionales'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            ActiveForm::class,
            UnactiveForm::class,
            ServiceForm::class,
            SpecialtyForm::class,
        ]);
    }

}
