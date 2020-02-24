<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class Specialty extends BaseEntity
{
    protected $table = 'specialties';

    protected $fillable = [
        'id',
        'name',
        'description',
        'state',
    ];

    public function professionals()
    {
      return $this->belongsToMany(User::class, 'specialty_user','specialty_id', 'user_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'specialty_services', 'specialty_id', 'service_id');
    }

    public function professionalSettings()
    {
        return $this->hasMany(ProfessionalSetting::class, 'specialty_id', 'id');
    }
}
