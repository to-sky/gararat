<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Part::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'producer_id' => $faker->swiftBicNumber,
        'price' => $faker->randomFloat(2, 0, 2500),
        'special_price' => $faker->randomFloat(2, 0, 2500),
        'is_special' => $faker->boolean,
        'qty' => $faker->randomDigit
    ];
});
