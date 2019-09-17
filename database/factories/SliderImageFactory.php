<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SliderImage;
use Faker\Generator as Faker;

$factory->define(SliderImage::class, function (Faker $faker) {
    return [
        'slider_id' => rand(1, 5),
        'title' => $faker->streetName,
        'description' => $faker->sentence,
      //  'image_url' => $faker->image(public_path()."/slider-images", 420,320,"nature", false),
        'image_url' => $faker->url,
        'url_btn_label' => $faker->city,
        'alt_text' => 'slider image',
        'url' => $faker->url
    ];
});
