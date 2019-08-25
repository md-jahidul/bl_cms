<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DigitalService;
use Faker\Generator as Faker;

$factory->define(DigitalService::class, function (Faker $faker) {
    return [
        'title' => $faker->streetName,
        'description' => $faker->sentence,
        'image' => 'service_image/'.$faker->image(public_path()."/storage/service_image", 420,320,"nature", false),
        'price' => rand(100, 999),
        'google_play_logo' => "google_play_logo/google_app_store.png",
        'apple_store_logo' => "apple_store_logo/apple-store-logo.png",
        'google_play_url' => "https://www.apple.com/itunes/charts/free-apps/",
        'apple_store_url' => 'https://play.google.com/store/apps',
    ];
});
