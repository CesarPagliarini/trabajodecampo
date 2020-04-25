<?php
namespace App\Core\SystemBuilder\Store;
use App\Core\SystemBuilder\FormBuilder;

class CategoryForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'categoriesForm'];

    protected $fields =[
        'name' => 'Categorias',
        'key' => 'categoriesForm',
        'target' => 'panel/categories',
        'icon' => 'fa fa-barcode',
        'state' => '1',
    ];


}
