<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class SaleOrderDetail extends BaseEntity
{

    protected $table = 'sales_order_details';
    protected $fillable = [
        'order_identifier',
        'product_id',
        'quantity',
        'unit_price',
        'total_item',
    ];

    public function product(){
       return $this->hasOne(Product::class, 'product_id', 'id');
    }

    public function order(){
        return $this->belongsTo(Product::class, 'id', 'order_identifier');
    }


}
