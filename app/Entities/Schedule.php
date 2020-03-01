<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;

class Schedule extends BaseEntity
{
    protected $table = 'schedules';

    protected $fillable = [
        'id',
        'schedule_header',
        'professional_id',
        'specialty_id',
        'attention_place_id',
        'shift_id',
        'hour',
        'date',
        'disponible',
        'cancel_date',
        'observation',
    ];
}
