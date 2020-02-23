<?php
namespace App\Core\SystemBuilder\Store;
use App\Core\SystemBuilder\FormBuilder;

class ProductForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'productForm'];

    protected $fields =[
        'name' => 'Productos',
        'key' => 'productForm',
        'target' => 'panel/products',
        'icon' => 'fa fa-superpowers',
        'state' => '1',
    ];


}
