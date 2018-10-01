<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

   public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
