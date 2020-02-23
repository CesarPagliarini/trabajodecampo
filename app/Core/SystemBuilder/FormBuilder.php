<?php


namespace App\Core\SystemBuilder;


abstract class FormBuilder extends AbstractBuilder
{
    function build(int $order = 0, $parentId = null)
    {

        $this->addField('order', $order);
        $this->addField('module_id', $parentId);
        $this->transact();
        $this->addToAdmin();
    }


    function say($message)
    {
        if($message === 'ok')
        {
            echo "El Formulario ".$this->fields['name']. " Se ha implementado correctamente"."\n";
        }
        else
        {
            $exit = '------------------------' . "\n";
            $exit .= "ya existe el formulario " . $this->fields['name'] . "\n";
            $exit .= '------------------------' . "\n";
            echo $exit;
        }
    }
}
