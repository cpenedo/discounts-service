<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeProductsDiscount extends Model
{
    protected $guarded = [];

    public $categoryId;

    public $minimumAmount;

    public $freeProducts;

    public function __construct($categoryId = 2, $minimumAmount = 6, $freeProducts = 1)
    {
        $this->categoryId = $categoryId;
        $this->minimumAmount = $minimumAmount;
        $this->freeProducts = $freeProducts;
    }

    public function calculate(Order $order)
    {
        $discount = [];
        $orderProducts = $order->orderProducts($this->categoryId)->get();

        foreach ($orderProducts as $index => $orderProduct) {

            $freeProductsQuantity = 0;
            $quantity = $orderProduct->quantity;

            if($quantity >= $this->freeProducts) {

                while($quantity >= $this->minimumAmount) {
                    $freeProductsQuantity += $this->freeProducts;
                    $quantity -= $this->freeProducts;
                }

                $discountValue = $orderProduct->product->price * $freeProductsQuantity;

                $discount[$index]['product_id'] = $orderProduct->product_id;
                $discount[$index]['free_quantity'] = $freeProductsQuantity;
                $discount[$index]['discount_value'] = $discountValue;

                $orderProduct->discount_value += $discountValue;
                $orderProduct->save();

                $order->total -= $discountValue;
                $order->total_discount += $discountValue;
                $order->save();
            }
        }

        if(empty($discount)) {
            return false;
        }

        return $discount;
    }
}
