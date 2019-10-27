<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyBlSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('sliders')->truncate();
            $slider_data = [
                'component_id' => 1,
                'title' => 'Home Slider',
                'description' => 'This is Home Slider',
                'short_code' => 'home_slider',
                'platform' => 'App',
            ];

            // insert to sliders

            $slider = \App\Models\Slider::create($slider_data);

            $slider_id = $slider->id;

            // put image
            DB::table('slider_images')->truncate();

            $slider_images = [
                'slider_id' => $slider_id,
                'title' => 'Title 1',
                'description' => "Home Slider 1",
                'image_url' => 'seeder-images/bl_slider_1.jpg',
                'alt_text' => 'home_1',
                'sequence' => 1,
                'is_active' => 1,
            ];

            \App\Models\SliderImage::create($slider_images);

            $slider_images = [
                'slider_id' => $slider_id,
                'title' => 'Title 2',
                'description' => "Home Slider 2",
                'image_url' => 'seeder-images/bl_slider_2.jpg',
                'alt_text' => 'home_2',
                'sequence' => 2,
                'is_active' => 1,
            ];

            \App\Models\SliderImage::create($slider_images);

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
