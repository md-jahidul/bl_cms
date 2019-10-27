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
        $sliders = ['Hero','Trending', 'Digital Services', 'Lifestyle & benefits', 'Testimonial'];
        $slidersBn = ['হিরো','প্রবণতা', 'ডিজিটাল পরিষেবা', 'লাইফস্টাইল এবং বেনিফিট', 'প্রশংসাপত্র'];

        foreach ($sliders as $key => $slider) {
            $other_attributes = [
                'sliding_speed' => 10,
                'view_list_btn_text_en' => "View all " . ( ($slider == 'Digital Services') ? 'Digital Services' : 'Offers' ),
                'view_list_btn_text_bn' => "সমস্ত পরিষেবা দেখুন",
                'view_list_url' =>  ($slider == 'Digital Services') ? '/view-all-digital-service' : '/priojon',
            ];

            $component_id = $key + 1;

            AlSlider::create([
                'title_en' =>  $slider,
                'title_bn' =>  $slidersBn[$key],
                'component_id' => $component_id,
                'short_code' => '[slider_' . $component_id . ']',
                'slider_type' => ($slider == 'Lifestyle & benefits' || $slider == 'Trending') ? 'multiple' : 'single',
                'other_attributes' => ($slider == 'Digital Services' || $slider == 'Lifestyle & benefits' || $slider == 'Trending') ? $other_attributes : ['sliding_speed' => 10]
            ]);
        }
    }
}
