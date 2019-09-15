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

        $siteLogo[] = ['icon' => 'logo/bl-logo.phg', 'url' => 'banglalink.net/home'];
        $address = "info@banglalink.net | +8801911304121 | For any query : pr@banglalink.net Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $copyRight = "© 2019 - Banglalink - All rights reserved";

        $socialIcons = ["facebook/facebook.png","twitter/twitter.jpg","linkedin/linkedin.png"];
        $url = ["facebook/facebook","twitter/twitter", "linkedin/linkedin"];
        foreach ($socialIcons as $key => $item) {
            $social_value[] = [
                'icon' => $item,
                'social_url' => $url[$key],
            ];
        }

        $site_logo_json = json_encode($siteLogo);
        $social_json = json_encode($social_value);

        $configKeys = ['site_logo', 'address', 'copy_right', 'social_item'];  /*'site_logo' 'address', 'copy_right', 'social_item'*/
        $configValue = [$site_logo_json, $address, $copyRight, $social_json];  /*$siteLogo, $address, $copyRight, $social_json*/


        foreach ($configKeys as $index => $keyItem) {
            Config::create([
                'key' => $keyItem,
                'value' => $configValue[$index]
            ]);
        }

    }
}
