<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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


    public function checkAndInsert(Array $data)
    {
        $this->days = collect(json_decode($data['days']));
        $this->professional_id = $data['professional_id'];
        $this->specialty_id = $data['specialty_id'];
        $this->attention_place_id = $data['attention_place_id'];
        $this->from = Carbon::createFromFormat('d/m/Y', $data['from'])->format('Y-m-d');
        $this->to = Carbon::createFromFormat('d/m/Y', $data['to'])->format('Y-m-d');
        $this->monday = ($this->days->where('day','Lunes')->first()) ? true : false;
        $this->tuesday = ($this->days->where('day','Martes')->first()) ? true : false;
        $this->wednesday =( $this->days->where('day','Miercoles')->first()) ? true : false;
        $this->thursday = ($this->days->where('day','Jueves')->first()) ? true : false;
        $this->friday = ($this->days->where('day','Viernes')->first()) ? true : false;
        $this->saturday = ($this->days->where('day','Sabado')->first()) ? true : false;
        $this->sunday = ($this->days->where('day','Domingo')->first()) ? true : false;
        $this->morning_schedule = $data['morning_schedule'];
        $this->afternoon_schedule = $data['afternoon_schedule'];
        $this->run_schedule  = $data['run_schedule'];

        $exist = DB::table($this->table)->where($this->attributes)->first();
        if( ! $exist ){
            $this->save();
            return true;
        }else{
            throw new \Exception('Esta configuracion de horarios ya existe.');
        }
    }
}
