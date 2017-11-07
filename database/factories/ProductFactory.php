<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->paragraph(),
        'image' => $faker->imageUrl(640, 320, 'transport'),
        'price' => $faker->numberBetween(5, 50), // Price per hour
    ];
});