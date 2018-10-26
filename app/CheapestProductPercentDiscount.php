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

    		$cheapestProduct = $order->orderProducts($this->category_id)->orderBy('price', 'asc')->first();

            $discount['product_id'] = $cheapestProduct->product_id;
            $discount['discount_value'] = number_format($cheapestProduct->product->price * (floatval($this->percentDiscount) / 100), 2);

    		return $discount;
        }
        
    	return $false;
    }
}
