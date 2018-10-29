<?php

namespace App\Repositories;

use App\OrderProduct;
use Illuminate\Support\Facades\DB as DB;

class OrderProductRepository
{
    public static function getOrderProduct($orderId, $productId)
    {
        return OrderProduct::where([
            ['order_id', '=', $orderId],
            ['product_id', '=', $productId]
            ])->first();
    }
}

