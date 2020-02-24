<?php


namespace App\Core\Entities;


use App\Core\Traits\UserExtensions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntity extends Model
{
    use UserExtensions;

    public $onSoftDelete = 'toggleState';

    public static function actives()
    {
        return self::where('state', '1')->get();
    }


    public function getCreatedParsedAttribute(){
        return Carbon::parse($this->created_at)->format('d/m/y');
    }










}
