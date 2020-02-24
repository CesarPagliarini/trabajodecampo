<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseEntity
{
    protected $table = 'services';

    protected $fillable = [
        'id',
        'name',
        'description',
        'state',
    ];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'specialty_services', 'service_id', 'specialty_id');
    }

    public function hasSpecialty($specialty_id)
    {
        return $this->specialties->pluck('id')->contains($specialty_id);

    }

    public function professionalSettings()
    {
        return $this->hasMany(ProfessionalSetting::class, 'service_id', 'id');
    }


}
