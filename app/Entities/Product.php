<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Carbon\Carbon;


class Product extends BaseEntity
{

    protected $table = 'products';
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
    public function getPriceAttribute()
    {
        return Price::where('vigency_from' , '<=' , Carbon::now())
            ->where('vigency_to' , '>=', Carbon::now())
            ->where('product_id', $this->id)->first();
    }


}
