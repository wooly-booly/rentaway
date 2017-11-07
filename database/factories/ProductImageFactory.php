<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductImage::class, function (Faker $faker) {
    return [
        'product_id' => function() { 
            return factory(App\Models\Product::class)->create()->id;
        },
        'image' => $faker->imageUrl(640, 320, 'transport'),
        'position' => $faker->randomDigitNotNull(),
    ];
});

