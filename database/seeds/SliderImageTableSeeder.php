<?php

use App\Models\AlSliderImage;
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
        AlSliderImage::truncate();

        for ($i = 1; $i < 4; $i++) {
            AlSliderImage::create([
                'id'    => $i,
                'slider_id' => 1,
                'title_en' =>  "Extra internet for all Banglalink users " . $i ,
                'title_bn' => "সমস্ত বাংলালিংক ব্যবহারকারীদের জন্য অতিরিক্ত ইন্টারনেট" . $i ,
                'image_url' => 'assetlite/images/slider-images/hero.jpg',
                'alt_text' => 'Hero slider image',
                'display_order' => count(AlSliderImage::get()) + 1,
                'other_attributes' => [
                    'button_label_en' => 'Internet Offers',
                    'button_label_bn' => 'ইন্টারনেট অফার',
                    'redirect_url' => '/offers',
                ]
            ]);
        }

        $digitalServiceSliders = ["Banglaflix","Mobile TV","Gaan Mela","Boi Ghor","Others"];
        $digitalServiceSlidersBn = ["বাংলাফ্লিক্স", "মোবাইল টিভি", "গানের মেলা", "বোই ঘোড়", "অন্যরা"];

        foreach ($digitalServiceSliders as $key => $digitalServiceSlider) {
            AlSliderImage::create([
                'id'    => $key + 4,
                'slider_id' => 3,
                'title_en' =>  $digitalServiceSlider,
                'title_bn' => $digitalServiceSlidersBn[$key],
                'start_date' => "2019-12-19 13:58:55",
                'image_url' => 'assetlite/images/slider-images/digital_service.png',
                'alt_text' => 'Digital service slider image',
                'display_order' => count(AlSliderImage::get()) + 1,
                'other_attributes' => [
                    'price_info' => 'Monthly 50',
                    'price_info_bn' => 'মাসিক ৫০',
                    'description_en' => 'Banglalink Mobile TV brings live TV Video on Demand (VOD) streaming on a mobile phone',
                    'description_bn' => 'বাংলালিংক মোবাইল টিভি একটি মোবাইল ফোনে স্ট্রিমিং ডাইমান্ড (ভিওডি) এ লাইভ টিভি ভিডিও নিয়ে আসে।',
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

        foreach ($testimonialSlidersEns as $key => $testimonialSlidersEn) {
            AlSliderImage::create([
                'id'    => $key + 9,
                'slider_id' => 5,
                'title_en' =>  $testimonialSlidersEn,
                'title_bn' =>  $testimonialSlidersEn,
                'image_url' => 'assetlite/images/slider-images/' . $userPic[$key],
                'alt_text' => 'testimonial slider image',
                'display_order' => count(AlSliderImage::get()) + 1,
                'other_attributes' => [
                    'client_name_en' => $testimonialSlidersEn,
                    'client_name_bn' => $testimonialSlidersBn[$key],
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
