<?php


namespace App\Core;
use App\Entities\Module;




use App\Core\interfaces\ComponentInterface;

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

        $element = '';
        foreach($this->componentList as $component){
          $element .=  $component->render();
        }
         echo $element;
    }


    public function checkActive()
    {
        // TODO: Implement checkActive() method.
    }
}
