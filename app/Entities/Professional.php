<?php

namespace App\Entities;

use App\Core\Repositories\ProfessionalSettingRepository;

class Professional extends User
{
    protected $shiftRepository;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->shiftRepository = new ProfessionalSettingRepository(new ProfessionalSetting());
    }

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

    public function getOwnedSpecialtiesAttribute()
    {
        return $this->shiftRepository->professionalSpecialties($this->id);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'specialty_user','user_id', 'specialty_id')
            ->groupBy('specialty_id');
    }





}
