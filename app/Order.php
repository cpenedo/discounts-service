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

    public function validationRules()
    {
        return [
            'id' => 'required|integer',
            'total' => 'required|numeric',
            'customer-id' => 'required|integer|exists:customer,id',   
        ];
    }

    public function loadAttributes($data)
    {
        return [
            'id' => request('id'),
			'total' => request('total'),
            'customer_id' => request('customer-id'),
        ];
    }

    public function checkDiscounts()
    {
        $discounts['total_discount_value'] = new TotalPercentDiscount;
        $discounts['free_products'] = new FreeProductsDiscount;
        $discounts['cheapest_product_discount'] = new CheapestProductPercentDiscount;

        $message = [];

        foreach($discounts as $key => $discount) {

            if($value = $discount->calculate()) {
                $message[$key] = $value;
            }

        }

        return $message;
    }

}
