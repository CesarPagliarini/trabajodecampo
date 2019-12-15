<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class StockMovement extends BaseEntity
{
    protected $fillable = [
        'product_id',
        'origin',
        'quantity_before',
        'quantity_after',
        'order_identifier',
    ];
}
