<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuickLaunchItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $quick_launch_items = [];
        $items = ["New connection","Packages","Roaming", "Digital Services","Helpline","My BL App","Helpline","Bondho SIM Offer","Banglalink Advance","eShop","Lifestyle & Benefits","Banglalink 4G"];
        $item_bn_text = ["নিউ কানেকশন","প্যাকেজ","রোমিং", "ডিজিটাল সার্ভিসেস","হেল্পলাইন","মাই বিএল অ্যাপ","হেল্পলাইন","বন্ধু সিম অফার","বাংলালিংক অ্যাডভান্স","ই-শপ","লাইফস্টাইল & বেনিফিটস","বাংলালিংক 4G"];

        foreach ($items as $key => $item) {
            $quick_launch_items[] = [
                'en_title' => $item,
                'bn_title' => $item_bn_text[$key],
                'image_url' => env('APP_URL', 'http://localhost:8000') . '/quick-launch-items/' . strtolower( str_replace( " ", "-", $item) ) . '.png',
                'alt_text' => $item,
                'link' => env('APP_URL', 'http://localhost:8000') . strtolower( str_replace( " ", "-", $item) ),
                'display_order' => ++$key
            ];
        }

        DB::table('quick_launch_items')->insert($quick_launch_items);
    }
}
