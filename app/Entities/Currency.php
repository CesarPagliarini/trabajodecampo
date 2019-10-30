<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Currency extends BaseEntity
{
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
