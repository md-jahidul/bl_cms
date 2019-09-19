<?php

use App\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siteLogo     = env('APP_URL', 'http://localhost:8000')."/images/logo/bl-logo.png";
        $logoAltText  = "Banglalink Logo";
        $email        = "info@banglalink.net";
        $query_email  = "info@banglalink.net";
        $mobileNumber = "+8801911304121";
        $address    = "pr@banglalink.net Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $copyRight    = "© 2019 - Banglalink - All rights reserved";
        $copyRightBangla    = "© ২০১৯ বাংলালিংক (বাংলালিংক ডিজিটাল কমিউনিকেশনস লিমিটেড)";
        $facebook     = "https://facebook.com/banglalink-page-fb";
        $twitter      = "https://twitter.com/banglalink-page";
        $linkedin     = "https://linkedin.com/banglalink-page-ln";
        $googlePlayLink = 'https://play.google.com/store/apps/details?id=com.arena.banglalinkmela.app';
        $appleAppstoreLink = 'https://apps.apple.com/us/app/my-banglalink/id934133022';


        $configKeys = ['site_logo','logo_alt_text', 'email', 'query_email', 'mobile_number', 'address', 'copy_right_en', 'copy_right_bn', 'facebook_url', 'twitter_url', 'linkedin_url', 'google_play_link', 'apple_app_store_link'];
        $configValue = [$siteLogo, $logoAltText, $email, $query_email, $mobileNumber, $address, $copyRight,$copyRightBangla, $facebook, $twitter, $linkedin,$googlePlayLink,$appleAppstoreLink];

        foreach ($configKeys as $index => $keyItem) {
            Config::create([
                'key' => $keyItem,
                'value' => $configValue[$index]
            ]);
        }

    }
}
