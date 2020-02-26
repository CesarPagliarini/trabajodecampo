<?php


namespace App\Core\Repositories;


use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use App\Entities\Professional;
use App\Entities\ProfessionalSetting;
use App\Entities\Service;
use App\Entities\Specialty;
use Illuminate\Support\Facades\DB;

class ProfessionalSettingRepository implements ProfessionalSettingRepositoryInterface
{
    protected $model;

    public function __construct(ProfessionalSetting $professiona_setting)
    {
        $this->model = $professiona_setting;
    }

    public function all()
    {
        // TODO: Implement all() method.
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
            ->select('specialties.*')
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


}
