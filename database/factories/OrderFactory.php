<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\Order::class, function (Faker $faker) {
    $trip_id = '';

    return [
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'trip_id' => function() use (&$trip_id) {
            return $trip_id = factory(App\Models\Trip::class)->create()->id;
        },
        'comment' => $faker->sentence(),
        'total' => function (array $post) use ($trip_id) {
            $trip = App\Models\Trip::find($post['trip_id'] ?? $trip_id);
            $trip_start = Carbon::parse($trip->trip_start);
            $trip_end = Carbon::parse($trip->trip_end);
            $hours = $trip_start->diffInHours($trip_end);

            return $hours * $trip->product->price;
        },
    ];
});