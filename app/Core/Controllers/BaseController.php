<?php


namespace App\Core\Controllers;


use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class BaseController extends Controller
{
    protected $model;

    public function bulkDelete(Request $request)
    {

        $class = "\App\Entities\\".ucfirst($request->model);

        if(class_exists($class)){
          $this->model = new $class();

        }else{
            return response()->json([
                'error' => true,
                'failed' => 'No models match'
            ]);
        };


        $failedItems = new Collection();
        $itemList = $this->model::whereIn('id', $request->ids)->get();
        foreach($itemList as $item)
        {
            DB::beginTransaction();
            try{
                if(isset($request->soft) && $request->soft == 'true' ){
                    $item->state = '0';
                    $item->save();
                    DB::commit();
                }else{
                    $item->delete();
                    DB::commit();
                }
            }
            catch(\Exception $e){
                DB::rollBack();
                $failedItems->push($e->getMessage());
            }
        }
        if($failedItems->count()){
            return response()->json([
                'error' => true,
                'failed' => $failedItems
            ]);
        }else{
            return response()->json([
                'error' => false,
                'failed' => ''
            ]);
        }
    }

}
