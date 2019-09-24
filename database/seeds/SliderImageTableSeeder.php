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
                'other_attributes' => [
                    'price_info' => 'Monthly 50',
                    'google_play_link' => 'https://play.google.com/store/apps/details?id=com.arena.banglalinkmela.app',
                    'app_store_link' => 'https://apps.apple.com/us/app/my-banglalink/id934133022'
                ]
            ]);
        }

        $testimonialSlidersEns = ["Shakib al hasan", "Musfiqur Rahim","Tamim Iqbal","Mostafizur Rrahman", "Mashrafi bin Morthaza"];
        $testimonialSlidersBn = ["সাকিব আল হাসান", "মুশফিকুর রাহিম", "তামিম ইকবাল ", "মোস্তাফিজুর রহমান", "মাশরাফি বিন মোর্তাজা"];
        $userPic = ["shakib_al_hasan.jpg", "musfiqur_rahim.jpg","tamim_iqbal.jpg","mostafizur_rrahman.jpg", "mashrafi_bin_morthaza.jpg"];

        $feedBackEn = "Banglalink provide the fastest internet throughout the country, I never get the best experience except using Banlalink. It’s awesome service ever, I’ll always use Banglalink.";

        $feedBackBn = "বাংলালিংক সারা দেশে দ্রুততম ইন্টারনেট সরবরাহ করে, আমি কখনও বাংলালিংক ব্যবহার ব্যতীত সেরা অভিজ্ঞতা পাই না। এটি সর্বদা দুর্দান্ত সেবা, আমি সর্বদা বাংলালিংক ব্যবহার করব।";

        foreach ($testimonialSlidersEns as $key => $testimonialSlidersEn){
            SliderImage::create([
                'id'    => $key + 9,
                'slider_id' => 3,
                'title' =>  $testimonialSlidersEn,
                'description' => "Banglalink Mobile TV brings live TV Video on Demand (VOD) streaming on a mobile phone",
                'image_url' => env('APP_URL', 'http://localhost:8000') . '/slider-images/'.$userPic[$key],
                'alt_text' => 'testimonial slider image',
                'url_btn_label' => 'button',
                'redirect_url' => '/testimonial',
                'sequence' => count(SliderImage::get()) + 1,
                'other_attributes' => [
                    'user_name_en' => $testimonialSlidersEn,
                    'user_name_bn' => $testimonialSlidersBn[$key],
                    'company_name_en' => 'Studiomaqs',
                    'company_name_bn' => 'স্টুডিওম্যাক্স',
                    'rating' => rand(1, 5),
                    'feedback_en' => $feedBackEn,
                    'feedback_bn' => $feedBackBn,
                ]
            ]);
        }

    }
}
