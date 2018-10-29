<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\OrderProductRepository;

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
                    $quantity -= $this->minimumAmount + $this->freeProducts;
                }

                $discountValue = number_format($orderProduct->product->price * $freeProductsQuantity, 2);

                $discount[$index]['product_id'] = $orderProduct->product_id;
                $discount[$index]['free_quantity'] = $freeProductsQuantity;
                $discount[$index]['discount_value'] = $discountValue;

                $orderProductObject = OrderProductRepository::getOrderProduct($orderProduct->order_id, $orderProduct->product_id);

                $orderProductObject->storeDiscountValue($discountValue);
            }
        }

        if(empty($discount)) {
            return false;
        }

        return $discount;
    }
}
