<?php


namespace App\Core\Traits;


trait UserExtensions
{
    public static function allAdmins()
    {
        return self::whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['Cliente']);
        })->get();
    }

    public static function allClients($state)
    {
        $state = $state === 'active' ? '1' : '0';
        return self::whereHas('roles', function($q){
            return $q->where('name', 'Cliente');
        })->where('state' , $state)->get();
    }


}
