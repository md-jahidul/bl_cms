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
        $menu_bangla = ['পরিচিতি','কভারেজ','মোবাইল নাম্বার পোর্টেবিলিটি','বিজনেস','লয়াল্টি','ই-শপ'];

        foreach ($menus as $key => $menu){
            FooterMenu::create([
                'name' => $menu,
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


        $sub_menus = ['Prepaid','Postpaid','Propaid'];
        $sub_menu_english =  ['Prepaid','Postpaid','Propaid'];
        $sub_menu_bangla = ['প্রিপেইড','পোষ্টপেইড','প্রপেইড'];

        foreach ($sub_menus as $key => $smenu){
            FooterMenu::create([
                'name' => $smenu,
                'en_label_text' => $sub_menu_english[$key],
                'bn_label_text' => $sub_menu_bangla[$key],
                'parent_id' => 2,
                'code' => str_replace( " ", "", $smenu),
                'url' => '/'. strtolower( str_replace( " ", "-", $smenu) ) ,
                'external_site' => 0,
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }
    }
}
