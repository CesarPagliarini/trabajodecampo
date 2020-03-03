<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ScheduleHeader extends Model
{
    protected $table = 'schedule_headers';

    public $days;

    protected $fillable = [
        'professional_id',
        'specialty_id',
        'attention_place_id',
        'from',
        'to',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'morning_schedule',
        'afternoon_schedule',
        'run_schedule',
    ];

    protected $data_to_store;

    protected $requested_interval_is_between;


    public function validateData(Array $data)
    {
        $this->data = $data;
        $this->days = collect(json_decode($data['days']));
        $registers = DB::table($this->table)
            ->where('professional_id', $data['professional_id'])
            ->get();



        $data_from =Carbon::createFromFormat('d/m/Y', $data['from']);
        $data_to =Carbon::createFromFormat('d/m/Y', $data['to']);
        if($data_to->lessThanOrEqualTo($data_from)){
            throw new \Exception('La fecha de inicio no puede ser mayor a la de finalizacion');
        }




        if($registers->isNotEmpty())
        {
            $this->validateDateRange($registers);
        }else{
            $this->continueProcedure();
        }

        return $this->data_to_store;
    }



    public function validateDateRange($db_register_collection)
    {

        $data_from =Carbon::createFromFormat('d/m/Y', $this->data['from']);
        $data_to =Carbon::createFromFormat('d/m/Y', $this->data['to']);

        $intervals_in_db = new Collection();
        foreach($db_register_collection as $db_register)
        {
            $intervals_in_db->push([
                'from' => Carbon::createFromFormat('Y-m-d', $db_register->from),
                'to' => Carbon::createFromFormat('Y-m-d', $db_register->to),
                'register_id' => $db_register->id,
            ]);
        }

        $isBetween = false;
        $intervals_in_db_ids = array();
        foreach($intervals_in_db as $interval)
        {
            $isBetweenFrom = $data_from->between($interval['from'], $interval['to']);
            $isBetweenTo = $data_to->between($interval['from'], $interval['to']);
            if($isBetweenFrom || $isBetweenTo)
            {
                $isBetween = true;
                $intervals_in_db_ids[] = intval($interval['register_id']);
            }
        }

        if($isBetween){
            $this->requested_interval_is_between = true;
            $intervals_db_registers = DB::table($this->table)->whereIn('id', $intervals_in_db_ids)->get();
            $this->validateDaysRange($intervals_db_registers);
        }
        else{
            $this->continueProcedure();
        };
    }
    public function validateDaysRange($db_register_collection)
    {
        $aviable_days = $this->aviableDays();
        foreach($db_register_collection as $register)
        {
            $mapped_days = $this->mapDays($register);

            if($aviable_days->isNotEmpty())
            {
                foreach($mapped_days as $owned_day)
                {
                    $aviable_days = $aviable_days->filter(function($aviable) use ($owned_day){
                       return $aviable['day'] != $owned_day['day'];
                    });
                }
            }
        }

        $aproved_days = new Collection();
        foreach($aviable_days as $aviable_day)
        {
            foreach($this->days as $requested_day)
            {
                if($requested_day->day === $aviable_day['day'])
                {
                    $aproved_days->push($requested_day);
                }
            }
        }


        if($aproved_days->isNotEmpty())
        {
            $this->days = $aproved_days;
            $this->continueProcedure();
        }
        else{
            throw new \Exception('Ya has agotado los dias seleccionados para el rango de fechas seleccionado');
        }

    }

    public function mapDays($register)
    {
        $mappeds = new Collection();

        ($register->monday) ? $mappeds->push(['id' => "0", "day" => 'Lunes']) : false;
        ($register->tuesday) ? $mappeds->push(['id' => "1", "day" => 'Martes']) : false;
        ($register->wednesday) ? $mappeds->push(['id' => "2", "day" => 'Miercoles']) : false;
        ($register->thursday) ? $mappeds->push(['id' => "3", "day" => 'Jueves']) : false;
        ($register->friday) ? $mappeds->push(['id' => "4", "day" => 'Viernes']) : false;
        ($register->saturday) ? $mappeds->push(['id' => "5", "day" => 'Sabados']) : false;
        ($register->sunday) ? $mappeds->push(['id' => "6", "day" => 'Domingos']) : false;

        return $mappeds;
    }
    public function aviableDays()
    {
        return new Collection([
            ['id' => "0", "day" => 'Lunes'],
            ['id' => "1", "day" => 'Martes'],
            ['id' => "2", "day" => 'Miercoles'],
            ['id' => "3", "day" => 'Jueves'],
            ['id' => "4", "day" => 'Viernes'],
            ['id' => "5", "day" => 'Sabados'],
            ['id' => "6", "day" => 'Domingos'],
        ]);
    }


    public function continueProcedure()
    {
        $data = $this->data;

        $days = $this->days;



        $specialties =  collect(json_decode($data['specialties_ids']));
        $specialties = $specialties->map(function($spec){
           return intval($spec->id);
        });

        $toAppend = array();
        foreach($specialties as $specialty_id)
        {
            $toAppend[] = [
                'professional_id'=> $data['professional_id'],
                'specialty_id'=>$specialty_id,
                'attention_place_id'=> $data['attention_place_id'],
                'from'=> Carbon::createFromFormat('d/m/Y', $data['from'])->format('Y-m-d'),
                'to'=>Carbon::createFromFormat('d/m/Y', $data['to'])->format('Y-m-d'),
                'monday'=> ($days->where('day','Lunes')->first()) ? true : false,
                'tuesday'=> ($days->where('day','Martes')->first()) ? true : false,
                'wednesday'=>( $days->where('day','Miercoles')->first()) ? true : false,
                'thursday'=> ($days->where('day','Jueves')->first()) ? true : false,
                'friday'=> ($days->where('day','Viernes')->first()) ? true : false,
                'saturday'=> ($days->where('day','Sabados')->first()) ? true : false,
                'sunday'=> ($days->where('day','Domingos')->first()) ? true : false,
                'morning_schedule'=> $data['morning_schedule'],
                'afternoon_schedule'=> $data['afternoon_schedule'],
                'run_schedule'=> $data['run_schedule'],
            ];
        }

        $this->data_to_store = $toAppend;

    }

}
