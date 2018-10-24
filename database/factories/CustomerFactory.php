<?php

use Faker\Generator as Faker;
use App\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'id' => rand(1, 500),
        'name' => $faker->word,
		'since' => $faker->date(),
        'revenue' => $faker->randomFloat(2, 0, 9999),
    ];
});
