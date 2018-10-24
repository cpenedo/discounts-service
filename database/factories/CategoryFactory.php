<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'id' => rand(1, 200),
        'name' => $faker->word,
    ];
});
