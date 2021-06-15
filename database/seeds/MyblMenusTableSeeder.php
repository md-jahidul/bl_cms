<?php

use Illuminate\Database\Seeder;
use App\Models\MyblAppMenu;
use Illuminate\Support\Facades\DB;

class MyblMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mybl_app_menus')->truncate();

        $menus = ['Plans','Account','App Settings','About'];
//        $menu_english = ['Home','Offers','Apps & Services','Business','Loyalty','Eshop'];
//        $menu_bangla = ['হোম','অফার','অ্যাপ & সার্ভিস','বিজনেস','লয়াল্টি','ই-শপ'];

        foreach ($menus as $key => $menu) {
            MyblAppMenu::create([
                'parent_id' => 0,
                'title_en' => $menu,
                'title_bn' => $menu,
                'icon' => null,
                'key' => strtolower(str_replace(" ", "_", $menu)),
                'status' => 1,
                'display_order' => $key + 1
            ]);
        }


        $parentIds = [
            1 => [
                'Internet Packs', 'Bundles', 'Amar Offer', 'Voice Packs', 'Orange Club'
            ],
            2 => [
                'Change Password', 'Refer & Earn', 'Switch account', 'My Profile'
            ],
            3 => [
                'Notification Settings', 'language'
            ],
            4 => [
                'FAQ', 'Terms & Conditions', 'Privacy Policy', 'Check For App Updates'
            ]
        ];

//        $sub_menu_english =  ['Prepaid','Postpaid','Propaid'];
//        $sub_menu_bangla = ['প্রিপেইড','পোষ্টপেইড','প্রপেইড'];

        foreach ($parentIds as $id => $sub_menus) {
            foreach ($sub_menus as $key => $menu) {
                MyblAppMenu::create([
                    'parent_id' => $id,
                    'title_en' => $menu,
                    'title_bn' => $menu,
                    'icon' => null,
                    'key' => strtolower(str_replace(" ", "_", $menu)),
                    'status' => 1,
                    'display_order' => $key + 1
                ]);
            }
        }
    }
}
