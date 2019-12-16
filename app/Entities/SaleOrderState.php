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
        switch ($this->name){

            case 'PENDIENTE':
                return 'fa fa-battery-empty';
            break;
            case 'RECHAZADA':
                return 'fa fa-times-rectangle';
            break;
            case 'ACEPTADA':
                return 'fa fa-battery-half';
            break;
            case 'EN PREPARACION':
                return 'fa fa-battery-3';
            break;
            case 'ENTREGADA':
                return 'fa fa-check';
            break;
            default:
                return '';
            break;

        }
    }

}
