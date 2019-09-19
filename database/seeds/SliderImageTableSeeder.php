<?php

use App\Models\SliderImage;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class SliderImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Models\SliderImage', 10)->create();

        for($i=1; $i < 4; $i++){
            SliderImage::create([
                'id'    => $i,
                'slider_id' => 1,
                'title' =>  "Extra internet for all Banglalink users " . $i ,
                'description' => "Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum ",
                'image_url' => env('APP_URL', 'http://localhost:8000') . '/slider-images/hero.png',
                'alt_text' => 'Hero slider image',
                'url_btn_label' => 'Internet Offers',
                'redirect_url' => '/offers',
                'sequence' => count(SliderImage::get()) + 1,
                'other_attributes' => null
            ]);
        }

        $digitalServiceSliders = ["Banglaflix","Mobile TV","Gaan Mela","Boi Ghor","Others"];

        foreach ($digitalServiceSliders as $key => $digitalServiceSlider){
            SliderImage::create([
                'id'    => $key + 4,
                'slider_id' => 2,
                'title' =>  $digitalServiceSlider,
                'description' => "Banglalink Mobile TV brings live TV Video on Demand (VOD) streaming on a mobile phone",
                'image_url' => env('APP_URL', 'http://localhost:8000') . '/slider-images/digital_service.png',
                'alt_text' => 'Digital service slider image',
                'url_btn_label' => '',
                'redirect_url' => '',
                'sequence' => count(SliderImage::get()) + 1,
                'other_attributes' => json_encode([
                    'price_info' => 'Monthly 50',
                    'google_play_link' => 'https://play.google.com/store/apps/details?id=com.arena.banglalinkmela.app',
                    'app_store_link' => 'https://apps.apple.com/us/app/my-banglalink/id934133022'
                ])
            ]);
        }
    }
}
