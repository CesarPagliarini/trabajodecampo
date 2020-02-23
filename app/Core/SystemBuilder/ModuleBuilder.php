<?php


namespace App\Core\SystemBuilder;



abstract class ModuleBuilder extends AbstractBuilder
{


    function build(int $order = 0)
    {

        $this->addField('order', $order);
        $this->transact();
        $this->callChilds();
    }


    function say($message)
    {
        if($message === 'ok')
        {
            echo "El Modulo ".$this->fields['name']. " Se ha implementado correctamente"."\n";
        }
        else
        {
            $exit = '------------------------' . "\n";
            $exit .= "ya existe el modulo " . $this->fields['name'] . "\n";
            $exit .= '------------------------' . "\n";
            echo $exit;
            return;

        }
    }

}
