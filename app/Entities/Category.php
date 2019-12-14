<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Category extends BaseEntity
{

    protected $fillable = [
        'name',
        'description',
        'state',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
