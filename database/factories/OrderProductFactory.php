<?php

use Faker\Generator as Faker;
use App\OrderProduct;
use App\Order;
use App\Product;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'quantity' => rand(1, 20),
		'unit_price' => $faker->randomFloat(2, 0, 100),
        'total' => $faker->randomFloat(2, 0, 9999),
        'order_id' => function() {
            return factory(Order::class)->create()->id;
        },
        'product_id' => function() {
            return factory(Product::class)->create()->id;
        },
    ];
});
