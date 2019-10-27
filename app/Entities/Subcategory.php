<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
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
