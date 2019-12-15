<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Price extends BaseEntity
{

    protected $fillable = [
        'value',
        'currency_id',
        'product_id',
        'vigency_from',
        'vigency_to'
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
