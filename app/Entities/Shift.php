<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class Shift extends BaseEntity
{
    protected $table = 'shifts';

    protected $fillable = [
        'id',
        'client_id',
        'professional_id',
        'specialty_id',
        'service_id',
        'attention_place_id',
        'currency_id',
        'from',
        'to',
        'asisted',
        'cancel_date',
        'observation',
    ];
}
