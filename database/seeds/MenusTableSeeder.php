<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = ['Home','Offers','Apps And Service','Bussiness','Loyalty','Eshop'];
        $menu_english = ['Home','Offers','Apps & Service','Bussiness','Loyalty','Eshop'];
        $menu_bangla = ['হোম','অফার','অ্যাপ & সার্ভিস','বিজনেস','লয়াল্টি','ই-শপ'];
        
        foreach ($menus as $key => $menu){
            Menu::create([
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
            Menu::create([
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
