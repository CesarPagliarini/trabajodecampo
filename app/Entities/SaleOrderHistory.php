<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class SaleOrderHistory extends BaseEntity
{

    protected $table = 'sales_order_history';

    protected $fillable = [
    'order_identifier',
    'state_id',
    'user_id',
    ];

    public function admin(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function state(){
        return $this->hasOne(SaleOrderState::class, 'id', 'state_id');
    }

    public function order(){
        return $this->hasOne(SaleOrder::class, 'id', 'order_identifier');
    }



}
