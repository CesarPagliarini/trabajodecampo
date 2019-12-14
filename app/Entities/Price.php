<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Price extends BaseEntity
{

    protected $fillable = [
        'value',
        'currency_id',
        'state',
        'product_id',
    ];
    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
