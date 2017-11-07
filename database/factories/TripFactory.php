<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\Trip::class, function (Faker $faker) {

    $trip_start = new Carbon('NOW + 24 hour');
    $trip_end = clone $trip_start;
    $trip_end->addHours($faker->numberBetween(10, 72));

    return [
        'product_id' => function() {
            return factory(App\Models\Product::class)->create()->id;
        },
        'trip_start' => $trip_start,
        'trip_end' => $trip_end,
    ];
});