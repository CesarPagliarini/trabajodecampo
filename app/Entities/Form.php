<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'key',
        'target',
        'icon',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions_forms' , 'form_id' );
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions_forms' , 'permission_id' );
    }

    public function getUsersAttribute()
    {
        $filtered = new Collection();
        foreach($this->roles as $rol){
            $filtered->push($rol->users->unique());
        }

        return $filtered;
    }








}
