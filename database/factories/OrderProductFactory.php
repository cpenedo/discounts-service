<?php

use Faker\Generator as Faker;
use App\OrderProduct;
use App\Order;
use App\Product;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'quantity' => rand(1, 20),
        'order_id' => function() {
            return factory(Order::class)->create()->id;
        },
        'product_id' => function() {
            return factory(Product::class)->create()->id;
        },
        'discount_value' => null
    ];
});
