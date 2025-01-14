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
        DB::statement("SET FOREIGN_KEY_CHECKS =0;");
        AlSlider::truncate();

        $sliders = ['Hero','Trending', 'Digital Services', 'Lifestyle & benefits', 'Testimonial', 'About-Media','Explore Devices', 'Ookla® Speedtest® Award 2020'];
        $slidersBn = ['হিরো','প্রবণতা', 'ডিজিটাল পরিষেবা', 'লাইফস্টাইল এবং বেনিফিট', 'প্রশংসাপত্র', 'সম্বন্ধে-মিডিয়া', 'এক্সপ্লোর ডিভাইসগুলি', 'ওকলা® স্পিডটেস্ট® অ্যাওয়ার্ড ২০২০'];

        foreach ($sliders as $key => $slider) {
            $other_attributes = [
                'sliding_speed' => 10,
                'view_list_btn_text_en' => "View all " . ( ($slider == 'Digital Services') ? 'Digital Services' : 'Offers' ),
                'view_list_btn_text_bn' => "সমস্ত পরিষেবা দেখুন",
                'view_list_url' =>  ($slider == 'Digital Services') ? '/view-all-digital-service' : '/priojon',
            ];

            $component_id = $key + 1;

            if ($slider == 'Ookla® Speedtest® Award 2020'){
                AlSlider::create([
                    'title_en' =>  $slider,
                    'title_bn' =>  $slidersBn[$key],
                    'component_id' => $component_id,
                    'short_code' => str_replace([' ','-'], '_', strtolower($slider)),
                    'slider_type' => ($slider == 'Lifestyle & benefits' || $slider == 'Trending') ? 'multiple' : 'single',
                    'other_attributes' =>  ['sliding_speed' => 10, 'type' => 'component_slider']
                ]);
            }else{
                AlSlider::create([
                    'title_en' =>  $slider,
                    'title_bn' =>  $slidersBn[$key],
                    'component_id' => $component_id,
                    'short_code' => str_replace([' ','-'], '_', strtolower($slider)),
                    'slider_type' => ($slider == 'Lifestyle & benefits' || $slider == 'Trending') ? 'multiple' : 'single',
                    'other_attributes' => ($slider == 'Digital Services' || $slider == 'Lifestyle & benefits' || $slider == 'Trending'  || $slider == 'Explore Devices') ? $other_attributes : ['sliding_speed' => 10]
                ]);
            }


        }
        DB::statement("SET FOREIGN_KEY_CHECKS =1;");
    }
}
