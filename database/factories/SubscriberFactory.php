<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'locale' => $faker->randomElement(['ar', 'en'])
    ];
});
