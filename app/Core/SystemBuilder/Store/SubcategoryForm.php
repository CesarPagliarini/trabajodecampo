<?php
namespace App\Core\SystemBuilder\Store;
use App\Core\SystemBuilder\FormBuilder;

class SubcategoryForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'subcategoriesForm'];

    protected $fields =[
        'name' => 'Subcategorias',
        'key' => 'subcategoriesForm',
        'target' => 'panel/subcategories',
        'icon' => 'fa fa-clone',
        'state' => '0',
    ];


}
