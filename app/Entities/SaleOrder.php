<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class SaleOrder extends BaseEntity
{

    protected $table = 'sales_order';

    protected $fillable = [
        'identifier',
        'state_id',
        'shipping_way',
        'sub_total',
        'client_id',
    ];

    public function client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }
    public function state(){
        return $this->hasOne(SaleOrderState::class, 'id', 'state_id');
    }

    public function details(){
        return $this->hasMany(SaleOrderDetail::class,'order_identifier', 'identifier');
    }






}
