<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productcategory()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }


    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'category_id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(ProductCategory::class, 'category_id')->with('categories');
    }
}
