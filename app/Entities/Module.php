<?php

namespace App\Entities;

use App\Entities\interfaces\ComponentInterface;
use Illuminate\Database\Eloquent\Model;

class Module extends Model implements ComponentInterface
{

    protected $fillable = [
        'name',
        'description',
        'internal_handler',
        'icon',
    ];
    //

    public function forms()
    {
        return $this->hasMany(Form::class, 'module_id','id');
    }
    public function render()
    {

        $element =  '
       <li>
            <a href="#"><i class="'.$this->icon.'"></i> <span class="nav-label">'.$this->name.'</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">';
            foreach($this->forms as $form){

                $element .= $form->render();
            }
            $element .= '</ul>
        </li>';

        return $element;
    }

}
