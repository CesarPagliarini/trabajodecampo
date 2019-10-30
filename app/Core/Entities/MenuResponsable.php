<?php


namespace App\Core\Entities;
use App\Entities\Module;




use App\Core\interfaces\ComponentInterface;
use Illuminate\Support\Facades\Route;

class MenuResponsable implements ComponentInterface
{

    protected $componentList;

    public function __construct(ComponentInterface $componentList)
    {
        $this->componentList = $componentList->all();
    }

    public static function make(){
        return new static(new Module());
    }

    public function render()
    {
        $element = '
         <li class="'.$this->checkActive().'">
                <a href="'.url('/panel').'"><i class="fa fa-home" aria-hidden="true"></i>
                    <span class="nav-label">
                    Home
                    </span>
                </a>
            </li>
            ';
        foreach($this->componentList as $component){
          $element .=  $component->render();
        }
         echo $element;
    }

    public function checkActive()
    {
        return Route::current()->uri === 'panel' ? 'active' : '';
    }
}
