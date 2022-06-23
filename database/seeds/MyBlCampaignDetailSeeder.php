<?php

use Illuminate\Database\Seeder;

class MyBlCampaignDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'my_bl_campaign_id' => 1,
                'recharge_amount' => 100,
                'cash_back_amount' => 10,
                'banner_image' => null,
                'thumb_image' => null,
                'cash_back_type' => 'fixed_amount',
                'purchase_eligibility' => 'recharge',
                'product_code' => 'Product112',
                'desc_en' => 'en',
                'desc_bn' => 'bn',
                'show_in_home' => true,
                'show_product_as' => 'campaign_only',
                'start_date' => "2022-06-15 14:45:00",
                'end_date' => "2022-06-15 14:45:00",
                'status' => true,
            ],
            [
                'my_bl_campaign_id' => 1,
                'recharge_amount' => 50,
                'cash_back_amount' => 10,
                'banner_image' => null,
                'thumb_image' => null,
                'cash_back_type' => 'percentage',
                'purchase_eligibility' => 'recharge',
                'product_code' => 'Product112',
                'desc_en' => 'en',
                'desc_bn' => 'bn',
                'show_in_home' => true,
                'show_product_as' => 'campaign_only',
                'start_date' => "2022-06-15 14:45:00",
                'end_date' => "2022-06-15 14:45:00",
                'status' => true,
            ]
        ];
        DB::table('my_bl_campaign_details')->insert($data);
    }
}
