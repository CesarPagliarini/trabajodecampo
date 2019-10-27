<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
