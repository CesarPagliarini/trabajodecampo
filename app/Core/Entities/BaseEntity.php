<?php


namespace App\Core\Entities;


use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    public static function actives(){
        return self::where('state', '1')->get();
    }




}
