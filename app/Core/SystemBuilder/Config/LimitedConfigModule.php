<?php


namespace App\Core\SystemBuilder\Config;

use App\Core\SystemBuilder\ModuleBuilder;
use App\Exceptions\ModuleExistanceException;


class LimitedConfigModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Configuraciones',
        'description' => 'admin/roles',
        'internal_handler' => 'config_handler',
        'icon' => 'fa fa-cog',
    ];

    protected $keys = ['name' => 'Configuraciones'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            UserForm::class,

        ]);

    }

}
