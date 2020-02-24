<?php
namespace App\Core\SystemBuilder\AttentionPlaces;
use App\Core\SystemBuilder\FormBuilder;

class AttentionPlacesForm extends FormBuilder
{


    public function __construct(){}

    protected $table = 'forms';

    protected $keys = ['key' => 'attentionPlacesForm'];

    protected $fields =[
        'name' => 'Centros de atencion',
        'key' => 'attentionPlacesForm',
        'target' => 'panel/attention-places',
        'icon' => 'fa fa-map-marker',
        'state' => '1',
    ];


}
