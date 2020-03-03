<?php


namespace App\Core\Repositories;


use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use App\Entities\Professional;
use App\Entities\ProfessionalSetting;

use App\Entities\Specialty;
use App\Events\AuditProfessionalSetting;
use App\Http\Resources\ProfessionalSettingResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfessionalSettingRepository implements ProfessionalSettingRepositoryInterface
{
    protected $model;


    public function __construct(ProfessionalSetting $professiona_setting)
    {
        $this->model = $professiona_setting;
    }


    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function professionalSpecialties($professional_id)
    {
        $query =  DB::table('specialties')
            ->join('professional_settings', 'specialties.id', '=', 'professional_settings.specialty_id')
            ->groupBy('professional_settings.specialty_id')
            ->where('professional_settings.professional_id', '=',$professional_id)
            ->get();

        $specialties = $query->map(function($item){
            return (new Specialty((array) $item));
        });
        return $specialties;
    }

    public function attentionCenterProfessionals($attention_center_id)
    {
        $query =  DB::table('users')
            ->join('professional_settings', 'users.id', '=', 'professional_settings.professional_id')
            ->groupBy('professional_settings.professional_id')
            ->where('professional_settings.attention_place_id', '=',$attention_center_id)
            ->get();

        $professionals = $query->map(function($item){
            return (new Professional((array) $item));
        });
        return $professionals;
    }

    public function serviceProfessionals($service_id)
    {
        $query =  DB::table('users')
            ->join('professional_settings', 'users.id', '=', 'professional_settings.professional_id')
            ->groupBy('professional_settings.professional_id')
            ->where('professional_settings.service_id', '=', $service_id)
            ->get();

        $services = $query->map(function($item){
            return (new Professional((array) $item));
        });
        return $services;
    }

    public function specialtyServices($specialty_id)
    {
        return DB::table('specialty_services')
            ->where('specialty_id',$specialty_id)
            ->join('services', 'specialty_services.service_id', 'services.id')
            ->select('services.*')
            ->get();
    }

    public function professionalSpecialtiesAttachedList($professional_id)
    {
        return DB::table('specialty_user')
            ->where('user_id',$professional_id)
            ->join('specialties', 'specialty_user.specialty_id', 'specialties.id')
            ->get();
    }

    public function getAttentionPlaces()
    {
        return DB::table('attention_places')
            ->where('state', '1')
            ->select('*')
            ->get();
    }

    public function getCurrencies()
    {
        return DB::table('currencies')
            ->where('state', '1')
            ->select('*')
            ->get();
    }

    public function addSettings($data)
    {
       $validate = [
            'professional_id' => $data['professional_id'],
            'specialty_id' => $data['specialty_id'],
            'service_id' => $data['service_id'],
            'attention_place_id' => $data['attention_place_id'],
        ];

        DB::beginTransaction();
        try{
            $this->checkExistance('professional_settings', $validate);
            $id = DB::table('professional_settings')->insertGetId($data);
            DB::commit();
            $data['id']  = $id;
            event(new AuditProfessionalSetting( Auth::user(), 'INSERT' , $data ));
            return response()->json([
                'error' => 'false',
                'message' => 'Se ha agregado con exito',
                'itemId' => $id
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => 'true',
                'message' => $e->getMessage(),
                'itemId' => null
            ]);
        }
    }

    public function removeSetting($setting_id)
    {
        DB::beginTransaction();
        try{
            //todo validar que no tenga horarios con turno,
            //todo fijarse que sea especialidad servicio profesional  centro de atencion y (auth que elimina)
            $data = DB::table('professional_settings')->where('id', $setting_id);
            $audit_data = $data->get()->first();
            event(new AuditProfessionalSetting( Auth::user(), 'DELETE' , (array)$audit_data ));;
            $data->delete();

            DB::commit();
            return response()->json([
                'error' => 'false',
                'message' => 'Se ha eliminado con exito',
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => 'true',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function checkExistance($table, $values)
    {
        $isAssoc = true;
        foreach(array_keys($values) as $key)
        {
            if (is_int($key))
            {
                $isAssoc = false;
            }
        }
        if( ! $isAssoc)
        {
            throw new \Exception('No es un array asociativo');
        }

        $finded = DB::table($table)->where($values)->get();

        if(count($finded))
        {
            throw new \Exception('Ya existe el registro');
        }

        return true;
    }

    public function getSettings($professional_id)
    {
        try{
            $settings = $this->model->where('professional_id',$professional_id)->get();

            $data = $settings->map(function($item){
                return new ProfessionalSettingResource($item);
            });

            return response()->json([
                'error' => 'false',
                'message' => 'List incoming',
                'data' => $data,
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => 'true',
                'message' => $e->getMessage()
            ]);
        }

    }


}
