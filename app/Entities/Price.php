<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
