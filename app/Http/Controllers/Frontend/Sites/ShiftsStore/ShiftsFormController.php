<?php


namespace App\Http\Controllers\Frontend\Sites\ShiftsStore;


use App\Core\Controllers\BaseController;
use App\Core\Interfaces\ControllerContract;
use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Core\interfaces\ProfessionalSettingRepositoryInterface;
use App\Entities\AttentionCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShiftsFormController extends BaseController implements ControllerContract
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
    )
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->settingRepository = $settingRepository;
    }

    public function aviableAttentionPlaces()
    {
        $data = $this->scheduleRepository->attentionPlacesWithShiftsAviables();
        return response()->json($data);
    }
    public function aviableSpecialties(Request $request)
    {
        $attention_place_id = $request->attention_place_id;
        $data = $this->scheduleRepository->aviableSpecialtiesFor($attention_place_id);
        return response()->json($data);
    }
    public function aviableServices(Request $request)
    {
        $specialty_id = $request->specialty_id;
        $data = $this->settingRepository->specialtyServices($specialty_id);
        return response()->json($data);
    }

    public function aviableSchedules(Request $request)
    {
        $specialty_id = $request->specialty_id;
        $attention_place_id = $request->attention_place_id;
        $service_id = $request->service_id;
        $data = $this->settingRepository->aviableSchedules($specialty_id,$attention_place_id,$service_id);

        return response()->json($data);
    }

    public function getShifts(Request $request)
    {

        $service_id= $request->service_id;
        $attention_place_id=$request->attention_place_id;
        $specialty_id=$request->specialty_id;
        $schedule_id = $request->schedule_id;

        $data = $this->scheduleRepository->shiftsFor($schedule_id, $service_id, $attention_place_id, $specialty_id);
        Session::forget('last_filtered_shifts');
        Session::put('last_filtered_shifts', $data);
        if(count(Session::get('last_filtered_shifts')))
        {

            return response()->json([
                'error' => false,
                'data' =>  route('frontend.select.shift')
            ]);

        }
        return response()->json([
            'error' => true,
            'message' => 'No hay turnos disponibles para el dia seleccionado'
        ]);
    }
    public function selectShift()
    {
        $shifts = collect(Session::get('last_filtered_shifts'));

        return view('frontend.sites.shifts-store.pages.selectshift', compact('shifts'));
    }

    public function reserveShift(Request $request)
    {
        $hour_sended = $request->hour;
        $date_sended = $request->date;
        $service_sended = $request->service_id;

        $client_id = Auth::user()->id;

        $data = $this->scheduleRepository->reserveShift($hour_sended, $date_sended,$client_id,$service_sended);
        return $data;


    }
}
