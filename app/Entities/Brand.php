<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Brand extends BaseEntity
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
