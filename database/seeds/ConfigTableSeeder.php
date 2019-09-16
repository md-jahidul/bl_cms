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

        $siteLogo     = "banglalink.net/home";
        $email        = "info@banglalink.net";
        $mobileNumber = "+8801911304121";
        $otherInfo   = "pr@banglalink.net Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $copyRight    = "© 2019 - Banglalink - All rights reserved";
        $facebook     = "facebook.com/banglalink-page-fb";
        $twitter      = "twitter.com/banglalink-page";
        $linkedin     = "linkedin.com/banglalink-page-ln";

        $configKeys = ['site_url', 'email', 'mobile_number', 'other_info', 'copy_right', 'facebook', 'twitter', 'linkedin'];
        $configValue = [$siteLogo, $email, $mobileNumber, $otherInfo, $copyRight, $facebook, $twitter, $linkedin];

        foreach ($configKeys as $index => $keyItem) {
            Config::create([
                'key' => $keyItem,
                'value' => $configValue[$index]
            ]);
        }

    }
}
