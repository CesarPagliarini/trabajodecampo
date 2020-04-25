<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Entities\Professional;
use App\Entities\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends BaseController implements ControllerContract
{
    protected $repository;

    /**
     * ShiftsModuleContract constructor.
     * @param ProfessionalScheduleRepositoryInterface $scheduleRepo
     */
    public function __construct(ProfessionalScheduleRepositoryInterface $scheduleRepo)
    {
        $this->repository = $scheduleRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professional = Auth::user();
        $professional = Professional::where('id', $professional->id)->with('settings')->first();
        $specialties = Specialty::whereHas('services')->get();
        $center_grouped_schedules = $this->repository->getForProfessional($professional->id);
        return view('backend.professionals.edit', compact('professional', 'specialties', 'center_grouped_schedules'));
//        return view('backend.shifts.schedules.index',compact('professional', 'specialties', 'center_grouped_schedules'));
    }


    public function getProfessionalSchedules(Request $request)
    {

    }
    public function addSchedule(Request $request)
    {
        return $this->repository->create($request->all());
    }
    public function removeSchedule(Request $request)
    {

    }



}
