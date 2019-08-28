<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use \App\Models\Campaign;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'motivational_quote' => $faker->slug,
        'start_date' => $faker->date('D-M-y'),
        'end_date' => $faker->date('D-M-y'),
        'is_enable' => 1,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
