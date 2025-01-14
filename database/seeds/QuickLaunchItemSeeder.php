<?php

use Carbon\Carbon;
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
//        DB::table('quick_launch_items')->truncate();

        $quick_launch_items = [];
        $items = ["New connection","Packages","Roaming", "Digital Services","Helpline","My BL App","Helpline","Bondho SIM Offer","Banglalink Advance","eShop","Lifestyle & Benefits","Banglalink 4G"];
        $item_bn_text = ["নিউ কানেকশন","প্যাকেজ","রোমিং", "ডিজিটাল সার্ভিসেস","হেল্পলাইন","মাই বিএল অ্যাপ","হেল্পলাইন","বন্ধু সিম অফার","বাংলালিংক অ্যাডভান্স","ই-শপ","লাইফস্টাইল & বেনিফিটস","বাংলালিংক 4G"];

        $qlButtonItemsEn = ["Quick Recharge","Amar Offer","Customer Care", "Internet offer","Dowload MyBl App"];
        $qlButtonItemsBn = ["কুইক রিচার্জ", "আমার অফার", "কাস্টমার কেয়ার", "ইন্টারনেট অফার", "মাইবিএল অ্যাপ ডাউনলোড করুন"];

        foreach ($items as $key => $item) {
            $quick_launch_items[] = [
                'title_en' => $item,
                'title_bn' => $item_bn_text[$key],
//                'image_url' => 'assetlite/images/quick-launch-items/' . strtolower(str_replace(" ", "-", $item)) . '.png',
                'alt_text' => $item,
                'link' => strtolower(str_replace(" ", "-", $item)),
                'type' => 'panel',
                'slug' => str_replace(' ', '_', strtolower($item)),
                'status' => 1,
                'display_order' => ++$key
            ];
        }

        foreach ($qlButtonItemsEn as $key => $item) {
            $quick_launch_items[] = [
                'title_en' => $item,
                'title_bn' => $qlButtonItemsBn[$key],
//                'image_url' => 'assetlite/images/quick-launch-items/' . strtolower(str_replace(" ", "-", $item)) . '.svg',
                'alt_text' => $item,
                'link' => strtolower(str_replace(" ", "-", $item)),
                'type' => 'button',
                'slug' => str_replace(' ', '_', strtolower($item)),
                'status' => 1,
                'display_order' => ++$key
            ];
        }

//        DB::table('quick_launch_items')->insert($quick_launch_items);
    }
}
