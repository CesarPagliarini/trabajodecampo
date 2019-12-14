<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Subcategory extends BaseEntity
{

    protected $fillable = [
        'name',
        'description',
        'state',
        'category_id',
    ];


    public function category()
    {
        return $this->hasOne(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
