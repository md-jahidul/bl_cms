<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SliderImage;
use Faker\Generator as Faker;

$factory->define(SliderImage::class, function (Faker $faker) {
    return [
        'slider_id' => rand(1, 4),
        'title' => $faker->streetName,
        'description' => $faker->sentence,
        'image_url' => $faker->image(public_path()."/slider-images", 420,320,"nature", false),
        'alt_text' => 'slider image',
        'url_btn_label' => 'View Details',
        'redirect_url' => $faker->url,
        'sequence' => count(SliderImage::get()) + 1,
        'other_attributes' => null
    ];
});
