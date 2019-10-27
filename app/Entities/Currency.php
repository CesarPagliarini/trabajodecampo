<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
