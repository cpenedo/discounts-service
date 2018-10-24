<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
