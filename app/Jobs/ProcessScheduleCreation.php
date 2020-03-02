<?php

namespace App\Jobs;

use App\Entities\ScheduleHeader;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessScheduleCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $extradata;

    /**
     * Create a new job instance.
     *
     * @param ScheduleHeader $scheduleHeader
     * @param array $extradata
     */
    public function __construct(Array $extradata)
    {
        $this->extradata = $extradata;
    }

    public function handle()
    {


        // se crea una colleccion con los tiempos que vienen en el schedule header
        $scheduleIntervals = array();
        $times = collect([
            $this->extradata['morning_schedule'],
            $this->extradata['afternoon_schedule'],
            $this->extradata['run_schedule']])
            ->filter(function($time){return $time != null;})
            ->map(function($time){ if($time != null) {return $time;} });

        //separo cada item de la coleccion en intervalos validos
        $times_finals = array();
        foreach($times as $key => $time){
            $time_intervals_array = explode(',' , $time);
            $carbon_intervals = array();

            //creo maximos y minimos en formatos date
            foreach($time_intervals_array as $time_interval){
                $time_exploded = explode(':', $time_interval);
                $carbon_intervals[] = Carbon::createFromTime($time_exploded[0], $time_exploded[1],0);
            }
            $times_finals[] = $carbon_intervals;
        }

        //calculo las diferencias por horario desde hasta de cada intervalo creado antes
        //se calcula la diferencia en minutos entre el mayor y el menor y divide por 15 ( hardcodeada hasta tener config)
        //se guardan los formatos en H.i ( string ) para proceder a insertar en la base de datos
        foreach($times_finals as $key => $interval)
        {
            $min = $interval[0];
            $max = $interval[1];
            $unit_times = ($max->diffInMinutes($min)) / 15 ;
            for($i = 1 ; $i <= $unit_times ; $i++){
                $date = $min->addMinutes(15)->format('H:i');
                $scheduleIntervals[] = $date;
            }
        }


        /**
         *weekmap maps days to spanish
        $weekMap = [
        0 => 'Lunes',
        1 => 'Martes',
        2 => 'Miercoles',
        3 => 'Jueves',
        4 => 'Viernes',
        5 => 'Sabado',
        6 => 'Domingo',
        ];
         */

        //formateo las fechas al formato de la base de datos y creo un periodo
        $data = $this->extradata;


        $user_selected_days = collect(json_decode($data['days']));





        $from = Carbon::createFromFormat('Y-m-d', $data['from'])->format('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d', $data['to'])->format('Y-m-d');

        $period = CarbonPeriod::create($from, $to);
        $sanatized = [];


        //aca esta la verdad de la milanesa
        // ya teniendo los intervalos de fechas separados, y los horarios separados
        //recorro cada item del periodo y filtro con los dias que tiene serializados el objeto scheduleheader que enviaron
        //cuando despacharon el evento,
        //si lo tiene, entonces por cada uno de los horarios calculados y separados antes
        //voy creando un item para impactar en la base de datos de forma totalmente violenta e innesesaria.
        $final_schedules = array();
        foreach ($period as $date) {
            $shouldImpact = ($user_selected_days->where('id',$date->dayOfWeek)->first()) ? true : false;
            if($shouldImpact){
                foreach($scheduleIntervals as $hour){
                    $final_schedules[] = [
                        'schedule_header' => $this->extradata['inserted_id'],
                        'professional_id' => $this->extradata['professional_id'],
                        'specialty_id' => $this->extradata['specialty_id'],
                        'attention_place_id' => $this->extradata['attention_place_id'],
                        'date' => $date->format('Y-m-d'),
                        'hour' => $hour,
                    ];
                }
                $sanatized[] = $date->format('Y-m-d');
            }
        }


        try{
            DB::beginTransaction();
                DB::table('schedules')->insert($final_schedules);
            DB::commit();

        }catch (\Exception $e){

            DB::rollBack();
            throw $e;
        }
    }
}
