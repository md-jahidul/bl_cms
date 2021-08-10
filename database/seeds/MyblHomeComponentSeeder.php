<?php

use Illuminate\Database\Seeder;
use App\Models\MyblHomeComponent;
use Illuminate\Support\Facades\DB;

class MyblHomeComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mybl_home_components')->truncate();

        $components = [
            [
                "component_key" => "home_slider",
                "title_en" => "Slider",
                "title_bn" => "স্লাইডার",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 1,
                "is_fixed_position" => true
            ],
            [
                "component_key" => "balance_detail",
                "title_en" => "Balance Details",
                "title_bn" => "ব্যালেন্স বিস্তারিত",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 2,
                "is_fixed_position" => true
            ],
            [
                "component_key" => "my_shorcut",
                "title_en" => "My Shortcuts",
                "title_bn" => "আমার শর্টকাট",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 3,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "amar_offer",
                "title_en" => "Amar Offer",
                "title_bn" => "আমার অফার",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 4,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "namaj_time",
                "title_en" => "Namaj Time",
                "title_bn" => "নামাজের সময়সূচী",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 5,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "refer_and_earn",
                "title_en" => "Refer And Earn",
                "title_bn" => "Refer And Earn",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 6,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "contexual_card",
                "title_en" => "Contextual Card",
                "title_bn" => "Contextual Card",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 7,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "internet_pack",
                "title_en" => "Internet Packs",
                "title_bn" => "ইন্টারনেট প্যাক",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 8,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "minute_pack",
                "title_en" => "Minute Packs",
                "title_bn" => "মিনিট প্যাক",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 9,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "bundle_pack",
                "title_en" => "Bundles",
                "title_bn" => "বান্ডেল",
                "is_api_call_enable" => true,
                "is_eligible" => false,
                "display_order" => 10,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "special_call_rate",
                "title_en" => "Special Call Rate",
                "title_bn" => "বিশেষ কল রেট",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 11,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "recharge_pack",
                "title_en" => "Recharge Offers",
                "title_bn" => "রিচার্জ অফার",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 12,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "sms_pack",
                "title_en" => "SMS Packs",
                "title_bn" => "এসএমএস প্যাক",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 13,
                "is_fixed_position" => false
            ],
            [
                "component_key" => "my_bl_feature",
                "title_en" => "Trending",
                "title_bn" => "Trending BN",
                "is_api_call_enable" => true,
                "is_eligible" => true,
                "display_order" => 14,
                "is_fixed_position" => false
            ]
        ];

        MyblHomeComponent::insert($components);
    }
}
