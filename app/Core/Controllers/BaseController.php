<?php


namespace App\Core\Controllers;



use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class BaseController extends Controller
{


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

                    if(isset($request->restore) && $request->restore == 'true'){
                        $item->state = "1";
                    }else{
                        $item->state = "0";
                    }
                    $item->save();


                    DB::commit();
                }else{
                    $item->delete();
                    DB::commit();
                }
            }
            catch(\Exception $e){
                DB::rollBack();
                $failedItems->push($item->name);
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
