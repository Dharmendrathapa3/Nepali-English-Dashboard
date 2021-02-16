<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    public function child()
    {
        return $this->belongsTo(ProductCategory::class, 'parent');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'parent');
    }
    public function childrenCategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent')->with('categories');
    }
}
