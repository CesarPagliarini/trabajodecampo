<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Product extends BaseEntity
{
    protected $fillable = [
        'description',
        'dimension',
        'unit',
        'provider',
        'state',
        'subcategory_id',
        'brand_id',
        'category_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
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
