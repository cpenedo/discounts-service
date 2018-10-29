<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheapestProductPercentDiscount extends Model
{
    public $categoryId;

    public $minimumAmount;
    
    public $percentDiscount;

    public function __construct($categoryId = 1, $minimumAmount = 2, $percentDiscount = 20)
    {
        $this->categoryId = $categoryId;
        $this->minimumAount = $minimumAmount;
        $this->percentDiscount = $percentDiscount;
    }

    public function calculate(Order $order)
    {
        $orderProducts = $order->orderProducts($this->categoryId)->get();

    	if(count($orderProducts) >= $this->minimumAmount) {

    		$cheapestOrderProduct = $order->orderProducts($this->category_id)->orderBy('price', 'asc')->first();

            $discountValue = number_format($cheapestOrderProduct->product->price * (floatval($this->percentDiscount) / 100), 2);

            $discount['product_id'] = $cheapestOrderProduct->product_id;
            $discount['discount_value'] = $discountValue;

            $cheapestOrderProduct->storeDiscountValue($discountValue);

    		return $discount;
        }
        
    	return $false;
    }
}
