<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Category extends BaseEntity
{
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
