<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(CategoryProduct::class);
    }

     public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
