<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class SaleOrder extends BaseEntity
{

    protected $table = 'sales_order';

    protected $fillable = [
        'identifier',
        'state_id',
        'observation',
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

    public function history(){
        return $this->hasMany(SaleOrderHistory::class, 'order_identifier', 'id');
    }

    public function getFullIdentifierAttribute(){
            return str_pad($this->identifier, 10, "0", STR_PAD_LEFT);

    }

    public function getLastModifiedAttribute(){
        return $this->history->sortByDesc('created_at')->first()->createdParsed;
    }
    public function getLastHistoryAttribute(){
        return $this->history->sortByDesc('created_at')->first();
    }

    public function getLastAdminAttribute(){

        $admin = $this->lastHistory->admin;
        if($admin && $admin->hasAccessToPanel()){
            return $admin->fullName;
        }else{
            return '---';
        }

    }






}
