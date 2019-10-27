<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SliderImage;
use Faker\Generator as Faker;

$factory->define(SliderImage::class, function (Faker $faker) {
    return [
        'slider_id' => rand(1, 2),
        'title' => $faker->streetName,
        'description' => $faker->sentence,
        'image_url' => env('APP_URL', 'http://localhost:8000') . '/slider-other-attr-images/' . $faker->image(public_path() . "/slider-other-attr-images", 420, 320, "nature", false),
        'alt_text' => 'slider-other-attr image',
        'url_btn_label' => 'View Details',
        'redirect_url' => $faker->url,
        'sequence' => count(SliderImage::get()) + 1,
        'other_attributes' => null
    ];
});
