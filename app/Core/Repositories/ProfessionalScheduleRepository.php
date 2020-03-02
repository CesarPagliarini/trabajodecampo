<?php


namespace App\Core\Repositories;


use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Entities\Schedule;
use App\Entities\ScheduleHeader;
use App\Jobs\ProcessScheduleCreation;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProfessionalScheduleRepository implements ProfessionalScheduleRepositoryInterface
{
    protected $schedule;
    protected $scheduleHeader;
    public function __construct(Schedule $schedule, ScheduleHeader $scheduleHeader)
    {
        $this->schedule = $schedule;
        $this->scheduleHeader = $scheduleHeader;
    }

    public function getForProfessional($professional_id)
    {
        $schedules =  DB::table('schedule_headers')
            ->where('professional_id', $professional_id)
            ->join('specialties', 'schedule_headers.specialty_id', 'specialties.id')
            ->join('attention_places', 'schedule_headers.attention_place_id', 'attention_places.id')

            ->select('specialties.name as specialty',
                'schedule_headers.*',
                'attention_places.name as attention_place')
            ->get();

        $schedules = $schedules->map(function($sch){
           $sch->from = Carbon::createFromFormat('Y-m-d', $sch->from)->format('d/m/Y');
           $sch->to = Carbon::createFromFormat('Y-m-d', $sch->to)->format('d/m/Y');
           $this->getScheduleTimes($sch)->each(function($time, $key)use($sch){
               $sch->{$key} = 'Desde las '.str_replace(',',' Hasta las ', $time);
           });
           return $sch;


        });
        $grouped_center = $schedules->groupBy('attention_place_id');
//        $grouped_interval = $schedules->groupBy(['from']);


        return $grouped_center;

    }


    public function create(array $data)
    {
        try
        {
            DB::beginTransaction();
            $data_to_store = $this->scheduleHeader->validateData($data);
            foreach($data_to_store as $data_to_store_item)
            {
                $id = DB::table('schedule_headers')->insertGetId($data_to_store_item);
                $data_to_store_item['inserted_id'] = $id;
                $data_to_store_item['days'] = $data['days'];
                ProcessScheduleCreation::dispatch($data_to_store_item)->onQueue('high');
            }
            DB::commit();
            return response()->json([
                'error' => false,
                'message' => 'Se ha guardado con exito la configuracion',
                'inserted_data' => $this->scheduleHeader,
            ]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getScheduleTimes($scheduleHeader){
        $times = collect([
            'morning_schedule' =>$scheduleHeader->morning_schedule,
            'afternoon_schedule' =>$scheduleHeader->afternoon_schedule,
            'run_schedule' =>$scheduleHeader->run_schedule])
            ->filter(function($time){return $time != null;})
            ->map(function($time, $key){ if($time != null) {return $time  ;} });
        return $times;
    }






    public function all($data)
    {
        return response()->json($data);
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
}
