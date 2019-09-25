<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notification;
use App\Models\NotificationCategory;
use Faker\Generator as Faker;



$factory->define(NotificationCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});


$factory->define(Notification::class, function (Faker $faker) {
    return [

        'title' => $faker->o,
        'body' => $faker->sentence,
        'category_id' => function () {
            return factory(App\Club::class)->create()->id;
        },
        'status' => 'INPROGRESS'

    ];
});



