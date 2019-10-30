<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Subcategory extends BaseEntity
{
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
