<?php


namespace App\Core\SystemBuilder\AttentionPlaces;

use App\Core\SystemBuilder\ModuleBuilder;

class AttentionPlacesModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Centros de atencion',
        'description' => 'Modulo de gestion de centros de atencion',
        'internal_handler' => 'shift_handler',
        'icon' => 'fa fa-map-marker',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Centros de atencion'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            AttentionPlacesForm::class
        ]);
    }

}
