<?php


namespace App\Core\SystemBuilder\Client;


use App\Core\SystemBuilder\ModuleBuilder;
use App\Exceptions\ModuleExistanceException;


class ClientModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Clientes',
        'description' => 'Modulo de gestion de clientes',
        'internal_handler' => 'client_handler',
        'icon' => 'fa fa-user',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Clientes'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            ActiveForm::class,
            UnactiveForm::class,
        ]);

    }

}
