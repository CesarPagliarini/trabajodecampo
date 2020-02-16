<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;
use Carbon\Carbon;


class Product extends BaseEntity
{


    protected $table = 'products';

    protected $fillable = [
        'description',
        'name',
        'dimension',
        'unit',
        'provider',
        'state',
        'subcategory_id',
        'stock',
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

    public function price(){
        return $this->hasOne(Price::class, 'product_id', 'id')
            ->where('vigency_to' , '>=', Carbon::now())
            ->where('product_id', $this->id)->first();

    }


    public function getPriceAttribute()
    {
        $price =  Price::where('vigency_from' , '<=' , Carbon::now())
            ->where('vigency_to' , '>=', Carbon::now())
            ->where('product_id', $this->id)->first();
        if($price){
            return $price->value;
        }

    }


}
