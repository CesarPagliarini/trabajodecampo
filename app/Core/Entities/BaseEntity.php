<?php


namespace App\Core\Entities;


use App\Core\Traits\UserExtensions;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    use UserExtensions;


    public static function actives()
    {
        return self::where('state', '1')->get();
    }









}
