<?php

namespace App\Http\Controllers\Backend\Shift;

use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShiftController extends  BaseController implements ControllerContract
{

    protected $settingRepository;
    protected $scheduleRepository;

    /**
     * ShiftsModuleContract constructor.
     * @param ProfessionalScheduleRepositoryInterface $scheduleRepository
     * @param ProfessionalSettingRepositoryInterface $settingRepository
     */
    public function __construct(
        ProfessionalScheduleRepositoryInterface $scheduleRepository,
        ProfessionalSettingRepositoryInterface $settingRepository
    ){
        $this->settingRepository = $settingRepository;
        $this->scheduleRepository = $scheduleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->scheduleRepository->getShiftsForProfessional(Auth::user()->id);
        return view('backend.shifts.shifts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
