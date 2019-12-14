<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Currency extends BaseEntity
{

    protected $fillable = [
        'description',
        'name',
        'origin',
        'state',
    ];
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
