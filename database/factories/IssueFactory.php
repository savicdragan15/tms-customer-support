<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Issue;
use Faker\Generator as Faker;

$factory->define(Issue::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'gender' => 'male',
        'order_number' => $faker->numerify('#'),
        'description' => $faker->realText('200'),
    ];
});
