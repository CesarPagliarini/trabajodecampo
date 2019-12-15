<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class SaleOrderState extends BaseEntity
{

    protected $table = 'sales_order_states';

    protected $fillable = [
        'name',
        'description',
    ];
}
