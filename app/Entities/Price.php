<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Price extends BaseEntity
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
