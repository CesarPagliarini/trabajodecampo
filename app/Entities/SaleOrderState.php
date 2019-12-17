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


    public function getIconAttribute(){

        switch (trim($this->name)){
            case 'PENDIENTE':

                return  '<i class="fa fa-battery-empty text-navy" style=" color:#f8ac59!important; font-size:22px!important;"></i>';
            break;
            case 'RECHAZADA':
                return  '<i class="fa fa-times-rectangle text-navy" style="color:#ed5565!important; font-size:22px!important;"></i>';
            break;
            case 'ACEPTADA':
                return  '<i class="fa fa-battery-half text-navy" style="color:#1c84c6!important; font-size:22px!important;"></i>';
            break;
            case 'EN PREPARACION':
                return '<i class="fa fa-battery-3 text-navy" style=" color:#23c6c8!important;  font-size:22px!important;"></i>';
            break;
            case 'ENTREGADA':
                return  '<i class="fa fa-check text-navy" style=" color:#1ab394!important; font-size:22px!important;"></i>';
                break;
            default:
                return '';
            break;

        }
    }

}
