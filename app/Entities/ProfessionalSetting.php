<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class ProfessionalSetting extends BaseEntity
{
    protected $table = 'professional_settings';

    protected $fillable = [
        'id',
        'professional_id',
        'specialty_id',
        'service_id',
        'attention_place_id',
        'time_unit',
        'work_holiday',
        'show_amount',
        'currency_id',
        'amount',
        'is_temporal',
        'is_highlighted',
    ];

    public function professional()
    {
        return $this->hasOne(Professional::class, 'id', 'professiona_id');
    }

    public function specialty()
    {
        return $this->hasOne(Specialty::class, 'id', 'specialty_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function attentionPlace()
    {
        return $this->hasOne(AttentionPlace::class, 'id', 'attention_place_id');
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }


}
