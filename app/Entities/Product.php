<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Product extends BaseEntity
{
    public function brand()
    {
        return $this->hasOne(Brand::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function subcategory()
    {
        return $this->hasOne(Subcategory::class);
    }
    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
