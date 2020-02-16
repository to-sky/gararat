<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(App\Models\Order::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'user_id' => array_rand(App\User::all()->map->id->toArray()),
        'status' => array_rand([
            Order::STATUS_QUEUED, Order::STATUS_IN_PROGRESS, Order::STATUS_COMPLETED, Order::STATUS_CANCELED
        ])
    ];
});
