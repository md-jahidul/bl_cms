<?php

use App\Models\FooterMenu;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class FooterMenuSeeder extends Seeder
{


    public function createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, $parentId)
    {
        foreach ($sub_menus as $key => $smenu) {
            FooterMenu::create([
                'en_label_text' => $sub_menu_english[$key],
                'bn_label_text' => $sub_menu_bangla[$key],
                'parent_id' => $parentId,
                'code' => str_replace(" ", "", $smenu),
                'url' => '/' . strtolower(str_replace(" ", "-", $smenu)) ,
                'external_site' => 0,
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }
    }

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

        foreach ($menus as $key => $menu) {
            FooterMenu::create([
                'en_label_text' => $menu_english[$key],
                'bn_label_text' => $menu_bangla[$key],
                'parent_id' => 0,
                'code' => str_replace(" ", "", $menu),
                'url' => '/' . strtolower(str_replace(" ", "-", $menu)) ,
                'external_site' => 0,
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }


        $sub_menus = ['About 4G','3G Coverage','Mobile Number Portability', 'Banglalink IT incubator', 'Share your experience', 'Partnership with Google: Kormo'];
        $sub_menu_english = ['About 4G','3G Coverage','Mobile Number Portability', 'Banglalink IT incubator', 'Share your experience', 'Partnership with Google: Kormo'];
        $sub_menu_bangla = ['4G পরিচিতি','3G কভারেজ','মোবাইল নাম্বার পোর্টেবিলিটি', 'আপনার অভিজ্ঞতা শেয়ার করুন', 'বাংলালিংক আইটি ইনকিউবেটর', 'গুগল কর্ম-এর সাথে পার্টনারশিপ'];

        $this->createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, 1);


        $sub_menus =  ["Prepaid", "Postpaid", "Roaming","Amar Offer","Bondho Sim offer", "Startup offer"];
        $sub_menu_english =  ["Prepaid", "Postpaid", "Roaming","Amar Offer","Bondho Sim offer", "Startup offer"];
        $sub_menu_bangla = ["প্রিপেইড", "পোস্টপেইড", "রোমিং","আমার অফার","বন্ধ সিম অফার", "স্টার্টআপ অফার"];

        $this->createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, 2);


        $sub_menus =  ["Apps", "VAS", "Financial Services", "Vibe", "Game On", "My Bl App"];
        $sub_menu_english =  ["Apps", "VAS", "Financial Services", "Vibe", "Game On", "My Bl App"];
        $sub_menu_bangla = ["অ্যাপস", "ভিএএস", "আর্থিক পরিষেবা", "ভাইবে", "গেম চালু", "আমার ব্ল অ্যাপ"];

        $this->createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, 3);


        $sub_menus =  ["Corporate", "SME",  "SOHO",  "WTTx",  "Business Solutions", "Be A Partner"];
        $sub_menu_english =  ["Corporate", "SME",  "SOHO",  "WTTx",  "Business Solutions", "Be A Partner"];
        $sub_menu_bangla = ["কর্পোরেট", "এসএমই", "সোহো", "ডব্লিউটিটিএক্স","ব্যবসায়িক সমাধান", "অংশীদার হোন"];

        $this->createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, 4);



        $sub_menus = ["Get New Connection", "4G", "Bondho Sim Offers", "ISD Tariff","IoT", "Priyojon","Chat with MITA", "Useful Contacts", "Store Locator", "Useful Information"];
        $sub_menu_english = ["Get New Connection", "4G", "Bondho Sim Offers", "ISD Tariff","IoT", "Priyojon","Chat with MITA", "Useful Contacts", "Store Locator", "Useful Information"];
        $sub_menu_bangla = ["নতুন সংযোগ পান", "4 জি", "বন্ধুহো সিম অফারগুলি", "আইএসডি ট্যারিফ", "আইওটি", "প্রিয়জন", "মিতার সাথে চ্যাট করুন", "দরকারী যোগাযোগ", "স্টোর লোকেটার", "দরকারী তথ্য" ];

        $this->createSubmenu($sub_menus, $sub_menu_english, $sub_menu_bangla, 5);
    }
}
