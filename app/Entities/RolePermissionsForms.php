<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RolePermissionsForms extends Model
{

    protected $fillable = [
        'role_id',
        'permission_id',
        'form_id',
    ];


}
