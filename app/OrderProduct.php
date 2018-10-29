<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function storeDiscountValue($discountValue)
    {
        $this->discount_value = $discountValue;
        
        if($this->save()) {
            return true;
        }

        return false;
    }
}
