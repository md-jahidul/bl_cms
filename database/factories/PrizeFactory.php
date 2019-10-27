<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Prize;
use Faker\Generator as Faker;

$factory->define(Prize::class, function (Faker $faker) {

    $position = array('1st', '2nd', '3rd',);
    $random_keys = array_rand($position, 3);

    return [
        'title' => $faker->jobTitle,
        'campaign_id' => factory('App\Models\Campaign')->create()->id,
        'product_id' => 0,
        'position' => $position[$random_keys[0]],
        'reword' => $faker->dateTime,
        'validity' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
