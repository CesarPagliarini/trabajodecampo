<?php


namespace App\Core\SystemBuilder\Store;

use App\Core\SystemBuilder\ModuleBuilder;

class StoreModule extends ModuleBuilder
{
    protected $fields =[
        'name' => 'Tienda',
        'description' => 'Modulo de gestion de Tienda',
        'internal_handler' => 'store_handler',
        'icon' => 'fa fa-suitcase',
        'state' => '1',
    ];

    protected $keys = ['name' => 'Tienda'];

    protected $table = 'modules';

    protected $childs;


    public function __construct()
    {
        $this->childs = collect([
            ProductForm::class,
            CategoryForm::class,
            SubcategoryForm::class,
            BrandsForm::class
        ]);
    }

}
