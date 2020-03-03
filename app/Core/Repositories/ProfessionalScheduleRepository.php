<?php


namespace App\Core\Repositories;


use App\Core\interfaces\ProfessionalScheduleRepositoryInterface;
use App\Entities\Schedule;
use App\Entities\ScheduleHeader;
use App\Jobs\ProcessScheduleCreation;
use Carbon\Carbon;
use Carbon\Traits\Creator;
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


    public function attentionPlacesWithShiftsAviables()
    {
        return DB::table('schedules')
            ->join('attention_places','schedules.attention_place_id', 'attention_places.id')
            ->distinct()
            ->select('attention_places.*')
            ->get();
    }
    public function aviableSpecialtiesFor($attention_place_id)
    {
        return DB::table('schedules')
            ->join('specialties','schedules.specialty_id', 'specialties.id')
            ->distinct()
            ->where('schedules.attention_place_id', $attention_place_id)
            ->select('specialties.*')
            ->get();
    }

    public function shiftsFor($schedule_id, $service_id, $attention_place_id, $specialty_id)
    {


        $schedule = DB::table('schedules')
            ->where('id', $schedule_id)
            ->select('date')
            ->first();
        $selected_attention_place = DB::table('attention_places')->where('id',$attention_place_id)
            ->select('*')->first();

        $data = DB::table('schedules')
            ->join('users', 'schedules.professional_id','users.id')
            ->select(
                'schedules.hour',
                        'schedules.disponible',
                        'users.name as professional_name',
                        'users.last_name as professional_last_name',
                        'users.id as professional_id')

            ->where('schedules.date', $schedule->date)
            ->get();
            $professionals_ids = $data->map(function($dat){
                return $dat->professional_id;
            });

            $professional_settings = DB::table('professional_settings')
            ->where([
               'service_id' => intval($service_id),
               'specialty_id' => intval($specialty_id),
               'attention_place_id' => intval($attention_place_id),
            ])
            ->select(
     'professional_settings.amount',
              'professional_settings.show_amount',
              'professional_settings.professional_id',
              'professional_settings.time_unit'
            )
            ->whereIn('professional_id', $professionals_ids)->get();

            $selected_service = DB::table('services')->where('id', $service_id)->first();
            $posible_shifts = $data;
            $viable_shifts = [];
            $non_aviable_shifts = [];

            $now = Carbon::now();
            $date_formated = Carbon::createFromFormat('Y-m-d', $schedule->date);
            $selected_date = $date_formated->format('d/m/Y');
            $days_remain = $now->diffInDays($date_formated);


                for($i = 0 ; $i < count($posible_shifts); $i++)
                {
                    $posible_shifts[$i]->selected_date = $selected_date;
                    $posible_shifts[$i]->days_remain = $days_remain;
                    $posible_shifts[$i]->attention_place = $selected_attention_place;
                    $posible_shifts[$i]->service = $selected_service;
                    $posible_shifts[$i]->schedule_id = $schedule_id;
                    $viable_shifts[] = $posible_shifts[$i];
                }

        return $viable_shifts;
    }

    public function reserveShift($hour_sended, $date_sended,$client_id ,$service_sended)
    {

        try{
        $date_sended_parsed = Carbon::createFromFormat('d/m/Y', $date_sended)->format('Y-m-d');
        $schedule_query = DB::table('schedules')
            ->where('date', $date_sended_parsed)
            ->where('hour', $hour_sended);
        $schedule =  $schedule_query->first();

        $professional = DB::table('users')->where('id', $schedule->professional_id)->first();

        $professional_settings = DB::table('professional_settings')
            ->where('professional_id', $professional->id)
            ->where('attention_place_id', $schedule->attention_place_id)
            ->where('specialty_id', $schedule->specialty_id)
            ->select('professional_settings.time_unit', 'professional_settings.currency_id')
            ->first();


            $time_units = $professional_settings->time_unit;
            $start_hour = $schedule->hour;
            $start_hour_formated = Carbon::createFromFormat('H:i', $start_hour);
            $minutes_to_add = $time_units * 15;
            $end_hour = $start_hour_formated->addMinutes($minutes_to_add);
            $end_hour_parsed = $end_hour->format('H:i');

        $shift_id = DB::table('shifts')->insertGetId([
            'client_id' => $client_id,
            'professional_id' => $professional->id,
            'specialty_id' =>$schedule->specialty_id,
            'service_id' => $service_sended,
            'attention_place_id' => $schedule->attention_place_id,
            'currency_id' => $professional_settings->currency_id,
            'from' => $start_hour,
            'to' => $end_hour_parsed,
        ]);
        $schedule_query->update([
            'disponible' => 0,
            'shift_id' => $shift_id,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Se ha agendado correctamente su turno'
        ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => true,
                'message' => 'No se pudo agendar su turno',
                'failwarning' => $e->getMessage()
            ]);
        }


    }


    public function getShiftsFor($client_id)
    {
        $shifts = DB::table('shifts')
            ->join('users','shifts.professional_id', 'users.id')
            ->join('specialties','shifts.specialty_id', 'specialties.id')
            ->join('attention_places','shifts.attention_place_id', 'attention_places.id')
            ->join('schedules','shifts.id', 'schedules.shift_id')
            ->join('services','shifts.service_id', 'services.id')
            ->distinct()
            ->select(
                'users.name as professional_name',
                'users.last_name as professional_last_name',
                'specialties.name as specialty_name',
                'attention_places.name as attention_place_name',
                'attention_places.address as attention_place_address',
                'attention_places.number as attention_place_number',
                'schedules.date as schedule_date',
                'shifts.from as from',
                'shifts.to as to',
                'services.name as service_name',
                'shifts.id as shift_id')
            ->where('client_id', $client_id)
            ->get();
        return $shifts;
    }

    public function getShiftsForProfessional($professional_id)
    {
        $shifts = DB::table('shifts')
            ->join('users','shifts.client_id', 'users.id')
            ->join('specialties','shifts.specialty_id', 'specialties.id')
            ->join('attention_places','shifts.attention_place_id', 'attention_places.id')
            ->join('schedules','shifts.id', 'schedules.shift_id')
            ->join('services','shifts.service_id', 'services.id')
            ->distinct()
            ->select(
                'users.name as client_name',
                'users.last_name as client_last_name',
                'specialties.name as specialty_name',
                'attention_places.name as attention_place_name',
                'attention_places.address as attention_place_address',
                'attention_places.number as attention_place_number',
                'schedules.date as schedule_date',
                'shifts.from as from',
                'shifts.to as to',
                'services.name as service_name',
                'shifts.id as shift_id',
                'shifts.created_at as register_date')
            ->where('shifts.professional_id', $professional_id)
            ->get();
        $events = [];
        foreach($shifts as $shift)
        {
            $to = Carbon::createFromFormat('H:i:s', $shift->to);
            $from =Carbon::createFromFormat('H:i:s', $shift->from);
            $string_from = $shift->schedule_date.'T'.$shift->from;
            $string_to = $shift->schedule_date.'T'.$shift->to;
            $events[] = [

                'title' => $shift->service_name,
                'start'=>  $string_from,
                'end' => $string_to,
                'allDay' =>  false,
                'client' => $shift->client_name .' '. $shift->client_last_name,
                'attention_place' => $shift->attention_place_name,
                'attention_place_address' => $shift->attention_place_address,
                'attention_place_number' => $shift->attention_place_number,
                'registered_at' => $shift->register_date
            ];
        }

        return $events;
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
