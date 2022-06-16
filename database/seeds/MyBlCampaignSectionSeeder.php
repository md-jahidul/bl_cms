<?php

use Illuminate\Database\Seeder;

class MyBlCampaignSectionSeeder extends Seeder
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
                'title_en' => "Flash Hour",
                'title_bn' => "Flash Hour BN",
                'slug' => "flash_hour",
                'display_order' => 1,
                'status' => true
            ],
            [
                'title_en' => "CashBack Campaign",
                'title_bn' => "CashBack Campaign BN",
                'slug' => "cashback_campaign",
                'display_order' => 2,
                'status' => true
            ],
            [
                'title_en' => "Weekly Campaign",
                'title_bn' => "Weekly Campaign BN",
                'slug' => "weekly_campaign",
                'display_order' => 3,
                'status' => true
            ]
        ];
        DB::table('my_bl_campaign_sections')->insert($data);
    }
}
