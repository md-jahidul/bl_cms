<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NotificationCategory;
use App\Models\NotificationDraft;
use Faker\Generator as Faker;

$factory->define(NotificationCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});


$factory->define(NotificationDraft::class, function (Faker $faker) {
    return [

        'title' => $faker->name,
        'body' => $faker->sentence,
        'category_id' => function () {
            return factory(NotificationCategory::class)->create()->id;
        }

    ];
});
