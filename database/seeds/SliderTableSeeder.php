<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $sliders = ['Hero','Explore Devices','Digital Services','Testimonial'];
        $sliders = ['Hero', 'Digital Services', 'Testimonial'];

        foreach ($sliders as $key => $slider){
            Slider::create([
                'title' =>  'Home page ' . $slider,
                'component_id' => ++$key,
                'description' => 'Description of ' . $slider,
                'short_code' => '[slider_'.++$key .']',
                'platform' => 'web',
                'other_attributes' => ($slider == 'Digital Services') ? [
                    'sliding_speed' => 10,
                    'view_list_btn_text_en' => "View all $slider",
                    'view_list_btn_text_bn' => "সমস্ত পরিষেবা দেখুন",
                    'view_list_url' => "/view-all-digital-service",
                ] : []
            ]);
        }
    }
}
