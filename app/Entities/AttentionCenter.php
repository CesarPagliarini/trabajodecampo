<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use App\Core\Repositories\ProfessionalSettingRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AttentionCenter extends BaseEntity
{

    protected $shiftRepository;

    public function __construct()
    {
        parent::__construct();
        $this->shiftRepository = new ProfessionalSettingRepository(new ProfessionalSetting());
    }
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
        return $this->shiftRepository->attentionCenterProfessionals($this->id);
    }




}
