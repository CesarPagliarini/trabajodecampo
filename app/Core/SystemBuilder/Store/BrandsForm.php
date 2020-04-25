<?php
namespace App\Core\SystemBuilder\Store;
use App\Core\SystemBuilder\FormBuilder;

class BrandsForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'brandsForm'];

    protected $fields =[
        'name' => 'Marcas',
        'key' => 'brandsForm',
        'target' => 'panel/brands',
        'icon' => 'fa fa-bookmark-o',
        'state' => '0'
    ];


}
