<?php

namespace App\Http\Controllers\Backend\Professional;

use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use App\Core\interfaces\ShiftsModuleContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProfessionalSettingsController extends Controller implements ShiftsModuleContract
{
    protected $repository;
    /**
     * ShiftsModuleContract constructor.
     * @param ProfessionalSettingRepositoryInterface $shiftRepo
     */
    public function __construct(ProfessionalSettingRepositoryInterface $shiftRepo)
    {
        $this->repository = $shiftRepo;
    }

    public function getSpecialtyServices(Request $request)
    {
        $data = $this->repository->specialtyServices($request->specialty_id);
        return response()->json($data);
    }

    public function getProfessionalSpecialties(Request $request)
    {
        $data = $this->repository->professionalSpecialtiesAttachedList($request->professional_id);
        return response()->json($data);
    }
    public function getAttentionPlaces()
    {
        $data = $this->repository->getAttentionPlaces();
        return response()->json($data);
    }

    public function getCurrenciesList()
    {
        $data = $this->repository->getCurrencies();
        return response()->json($data);
    }

    public function addSettings(Request $request)
    {
        return response()->json($request->all());
    }


}
