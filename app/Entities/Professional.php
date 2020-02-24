<?php

namespace App\Entities;



class Professional extends User
{
    protected $table = 'users';

    public function settings()
    {
        return $this->hasMany(ProfessionalSetting::class, 'professional_id', 'id');
    }

    public function highlighted_specialty()
    {
        return $this->hasOne(ProfessionalSetting::class, 'professional_id', 'id')
            ->where('is_highlighted', '1')
            ->with('specialty', 'service');
    }





}
