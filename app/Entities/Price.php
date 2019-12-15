<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Carbon\Carbon;


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
    public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }


}
