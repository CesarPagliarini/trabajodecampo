<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use Illuminate\Http\Request;

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
        return view('backend.shifts.schedules.index');
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
