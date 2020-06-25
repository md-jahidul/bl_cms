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
        Config::truncate();

        $siteLogo     = "assetlite/images/logo/bl-logo.png";
        $logoAltText  = "Banglalink Logo";
        $email        = "info@banglalink.net";
        $query_email  = "info@banglalink.net";
        $mobileNumber = "+8801911304121";
        $mobileBn = "+8801911304121";
        $address    = "pr@banglalink.net Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $addressBn    = "pr@banglalink.net Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $copyRight    = "© 2019 - Banglalink - All rights reserved";
        $copyRightBangla    = "© ২০১৯ বাংলালিংক (বাংলালিংক ডিজিটাল কমিউনিকেশনস লিমিটেড)";
        $facebook     = "https://facebook.com/banglalink-page-fb";
        $twitter      = "https://twitter.com/banglalink-page";
        $linkedin     = "https://linkedin.com/banglalink-page-ln";
        $youTube     = "https://www.youtube.com/user/banglalinkmela";
        $instagram     = "https://www.instagram.com/banglalink.digital/?hl=en";
        $googlePlayLink = 'https://play.google.com/store/apps/details?id=com.arena.banglalinkmela.app';
        $appleAppStoreLink = 'https://apps.apple.com/us/app/my-banglalink/id934133022';
        $imageUploadSize = 2;
        $imageUploadType = 'jpeg,png';
        $adminImageUploadSize = 5;
        $adminImageUploadType = 'jpeg,png';
        $advanceMinimumBalance = 10;
        $headerScript = "";
        $bodyScript = "";

        $configKeys = ['site_logo', 'logo_alt_text', 'email', 'query_email',
            'mobile_number_EN', 'mobile_number_BN', 'address_EN', 'address_BN', 'copy_right_EN', 'copy_right_BN',
            'facebook_url', 'twitter_url', 'linkedin_url', 'youtube_url', 'instagram_url', 'google_play_link',
            'apple_app_store_link', 'image_upload_size', 'image_upload_type', 'admin_image_upload_size',
            'admin_image_upload_type', 'advance_minimum_balance', 'header_script',  'body_script'];

        $configValue = [$siteLogo, $logoAltText, $email, $query_email, $mobileNumber, $mobileBn, $address, $addressBn, $copyRight,
            $copyRightBangla, $facebook, $twitter, $linkedin, $youTube, $instagram,
            $googlePlayLink, $appleAppStoreLink, $imageUploadSize, $imageUploadType, $adminImageUploadSize,
            $adminImageUploadType, $advanceMinimumBalance, $headerScript, $bodyScript];

        foreach ($configKeys as $index => $keyItem) {
            Config::create([
                'key' => $keyItem,
                'value' => $configValue[$index]
            ]);
        }
    }
}
