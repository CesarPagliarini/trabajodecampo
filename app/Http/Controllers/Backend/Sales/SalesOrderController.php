<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Core\Controllers\BaseController;
use App\Core\Entities\StateHanddler;
use App\Core\Interfaces\ControllerContract;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SalesOrderController extends  BaseController implements ControllerContract
{

    protected $state_handler;

    public function __construct(StateHanddler $state_handler)
    {
        $this->state_handler = $state_handler;
    }

    public function index(Request $request)
    {
        $data = $this->state_handler::resolve($request, 'index');
        return view('backend.sales.orders.index', $data);
    }

    public function edit( Request $request, SaleOrder $order)
    {
        $data = $this->state_handler::resolve($request, 'edit' , $order);

        return view('backend.sales.orders.edit', $data);

    }

    public function update(Request $request, SaleOrder $order)
    {

        $data = $this->state_handler::resolve($request, 'update' , $order);
        if($data['status']){
//            $request->session()->flash('flash_message', $data['message']);
            return redirect()->to($data['redirection'])->with('flash_message', $data['message']);
        }
//        $request->session()->flash('flash_error', 'La orden no se pudo actualizar');
        return redirect()->back()->with('flash_error', $data['message']);

    }


    public function reject(Request $request)
    {
        $order = SaleOrder::find($request->order_id);
        try{
            DB::beginTransaction();
            $order->update(['state_id' => 2, 'observation' => strip_tags($request->observation)]);
            SaleOrderHistory::create([
               'order_identifier' => $order->identifier,
               'state_id' => $order->state_id,
                'user_id' => Auth::user()->id
            ]);
            DB::commit();
            $response = [
                'status' => 'success',
                'error' => false,
            ];

        }catch(\Exception $e){
            $response = $e->getMessage();
        }
        return response()->json($response);

    }
}
