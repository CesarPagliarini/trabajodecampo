<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
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
      return $this->belongsToMany(User::class, 'specialty_user','specialty_id', 'user_id')->withPivot('id');
    }
}
