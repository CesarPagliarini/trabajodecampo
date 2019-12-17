<?php


namespace App\Core\Interfaces;
use App\Entities\SaleOrder;
use Illuminate\Http\Request;

interface OrderStateInterface
{

    function __construct(Request $request,  $order = null);

    function edit();

     function update();

     function index();

     function returnState();


}
