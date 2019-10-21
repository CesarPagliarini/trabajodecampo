<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'action',
        'icon',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions_forms' , 'permission_id' );
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'role_permissions_forms' , 'permission_id' );
    }
}
