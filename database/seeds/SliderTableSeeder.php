<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AlSlider;

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
        $slidersBn = ['হিরো', 'ডিজিটাল পরিষেবা', 'প্রশংসাপত্র'];

        foreach ($sliders as $key => $slider){

            $other_attributes = [
                'sliding_speed' => 10,
                'description_en' => 'Description of ' . $slider,
                'description_bn' => 'Description of ' . $slider,
                'view_list_btn_text_en' => "View all $slider",
                'view_list_btn_text_bn' => "সমস্ত পরিষেবা দেখুন",
                'view_list_url' => "/view-all-digital-service",
            ];

            $component_id = $key + 1;

            AlSlider::create([
                'title_en' =>  $slider,
                'title_bn' =>  $slidersBn[$key],
                'component_id' => $component_id,
                'short_code' => '[slider_'. $component_id .']',
                'other_attributes' => ($slider == 'Digital Services') ? $other_attributes : ['sliding_speed' => 10]
            ]);
        }
    }
}
