<?php


namespace App\Core\Interfaces;




interface OrderStateInterface
{

    public function __construct();

    public static function state();

     function editionState();
     function creationState();
     function indexState();
     function getState();
}
