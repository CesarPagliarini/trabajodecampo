<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class AttentionPlace extends BaseEntity
{
    protected $table = 'attention_places';

    protected $fillable=[
        'id',
        'address',
        'number',
        'floor',
        'apartment'  ,
    ];
}
