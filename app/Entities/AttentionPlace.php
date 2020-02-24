<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttentionPlace extends BaseEntity
{
    protected $table = 'attention_places';

    protected $fillable=[
        'id',
        'name',
        'description',
        'address',
        'number',
        'floor',
        'phone',
        'apartment',
        'state',
        'province',
        'city',
        'country',
    ];

    public function professionalSettings()
    {
        return $this->hasMany(ProfessionalSetting::class, 'attention_place_id', 'id');
    }

    public function getProfessionalsAttribute()
    {

        $query =  DB::table('users')
            ->join('professional_settings', 'users.id', '=', 'professional_settings.professional_id')
            ->where('professional_settings.attention_place_id', '=',$this->id)
            ->get();

        $professionals = $query->map(function($item){
            return (new Professional((array) $item));
        });
        return $professionals;


    }




}
