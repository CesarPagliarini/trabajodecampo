<?php


namespace App\Core\Traits;

use App\Core\Entities\BaseEntity;

use App\Exceptions\NonModelForSoftDeleteException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

trait DeleteHandlerTrait
{
    public $request;

    public $fails;

    public $entity;



    public function bulkDelete(Request $request)
    {
        $class = "App\Entities\\".ucfirst($request->model);

        if(! class_exists($class))
        {
            throw new NonModelForSoftDeleteException('Requested class not exist.');
        }

        $this->fails = new Collection();
        $this->request = $request;
        $this->entity = new $class();

        return $this->handle();
    }


    private function handle()
    {

        return isset($this->entity->onSoftDelete) ? property_exists($this->entity,'onSoftDelete') ?
            call_user_func(array($this, $this->entity->onSoftDelete), $this->entity)
            :  (new NonModelForSoftDeleteException('Requested class dosnt implemnnts soft deletes correctly.'))->render()
            :  (new NonModelForSoftDeleteException('Requested class dosnt support soft deletign feature.'))->render();

    }

    protected function delete(BaseEntity $entity)
    {
        try{
            DB::table($entity->getTable())->whereIn('id',$this->request->ids)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Se han eliminado los registros correctamente'
            ]);
        }catch (Exception $e){
            throw new NonModelForSoftDeleteException('No se han podido eliminar los registros seleccionados');
        }
    }


    protected function active()
    {
        DB::beginTransaction();
        try{
            DB::table($this->entity->getTable())->whereIn('id',$this->request->ids)->update(['state' => '0']);
            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'Se han desactivado los registros correctamente'
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw new NonModelForSoftDeleteException('No se han podido desactivar los registros seleccionados');
        }
    }

    protected function unactive()
    {
        DB::beginTransaction();
        try{
            DB::table($this->entity->getTable())->whereIn('id',$this->request->ids)->update(['state' => '1']);
            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'Se han activado los registros correctamente'
            ]);
        }
        catch(\Exception $e){
            DB::rollBack();
            throw new NonModelForSoftDeleteException('No se han podido activar los registros seleccionados');
        }
    }


}
