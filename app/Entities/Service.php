<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseEntity
{
    protected $table = 'services';

    protected $fillable = [
        'id',
        'name',
        'description',
        'state',
    ];

}
