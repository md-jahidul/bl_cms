<?php

use App\Models\FooterMenu;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class FooterMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = ['About','Offers','Apps And Service','Bussiness','Useful Links'];
        $menu_english = ['About','Offers','Apps And Service','Bussiness','Useful Links'];
        $menu_bangla = ['পরিচিতি','কভারেজ','অ্যাপ & সার্ভিস','বিজনেস','লয়াল্টি','ই-শপ'];

        foreach ($menus as $key => $menu){
            FooterMenu::create([
                'en_label_text' => $menu_english[$key],
                'bn_label_text' => $menu_bangla[$key],
                'parent_id' => 0,
                'code' => str_replace( " ", "", $menu),
                'url' => '/'. strtolower( str_replace( " ", "-", $menu) ) ,
                'external_site' => 0,
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }


        $sub_menus = ['About 4G','3G Coverage','Mobile Number Portability', 'Banglalink IT incubator', 'Share your experience', 'Partnership with Google: Kormo'];
        $sub_menu_english = ['About 4G','3G Coverage','Mobile Number Portability', 'Banglalink IT incubator', 'Share your experience', 'Partnership with Google: Kormo'];
        $sub_menu_bangla = ['4G পরিচিতি','3G কভারেজ','মোবাইল নাম্বার পোর্টেবিলিটি', 'আপনার অভিজ্ঞতা শেয়ার করুন', 'বাংলালিংক আইটি ইনকিউবেটর', 'গুগল কর্ম-এর সাথে পার্টনারশিপ'];

        foreach ($sub_menus as $key => $smenu){
            FooterMenu::create([
                'en_label_text' => $sub_menu_english[$key],
                'bn_label_text' => $sub_menu_bangla[$key],
                'parent_id' => 1,
                'code' => str_replace( " ", "", $smenu),
                'url' => '/'. strtolower( str_replace( " ", "-", $smenu) ) ,
                'external_site' => 0,
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }
    }
}
