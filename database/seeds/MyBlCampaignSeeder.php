<?php

use Illuminate\Database\Seeder;

class MyBlCampaignSeeder extends Seeder
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
                'mybl_campaign_section_id' => 1,
                'base_groups_id' => 2,
                'exclude_base_groups_id' => 1,
                'first_sign_up_user' => 0,
                'user_group_type' => 'segment_wise',
                'name' => "MyBl Flash",
                'type' => "recharge",
                'winning_type' => 'first_recharge',
                'winning_interval' => 10,
                'winning_interval_unit' => 'hour',
                'reward_bonus_code' => 'Bonus11',
                "winning_massage_en" => "Message EN",
                "winning_massage_bn" => "Message BN",
                'deno_type' => 'all_deno',
                'recurring_type' => 'daily',
                'reward_getting_type' => 'single_time',
                'number_of_apply_times' => 10,
                'max_amount' => 500,
                'purchase_eligibility' => 'recharge',
                'payment_gateways' => json_encode(['bkash', 'ebl']),
                'payment_channels' => null,
                'start_date' => "2022-06-15 14:45:00",
                'end_date' => "2022-06-15 14:45:00",
                'status' => true,
                'created_at' => \Illuminate\Support\Carbon::now('UTC')->toDateTimeString(),
                'updated_at' => \Illuminate\Support\Carbon::now('UTC')->toDateTimeString()
            ],
            [
                'mybl_campaign_section_id' => 1,
                'base_groups_id' => 3,
                'exclude_base_groups_id' => 8,
                'first_sign_up_user' => 0,
                'user_group_type' => 'segment_wise',
                'name' => "CashBack Campaign",
                'type' => "recharge",
                'winning_type' => 'first_recharge',
                'winning_interval' => 10,
                'winning_interval_unit' => 'hour',
                'reward_bonus_code' => 'Bonus11',
                "winning_massage_en" => "Message CashBack Campaign EN",
                "winning_massage_bn" => "Message CashBack Campaign BN",
                'deno_type' => 'all_deno',
                'recurring_type' => 'daily',
                'reward_getting_type' => 'single_time',
                'number_of_apply_times' => 10,
                'max_amount' => 500,
                'purchase_eligibility' => 'recharge',
                'payment_gateways' => json_encode(['bkash', 'ebl']),
                'payment_channels' => null,
                'start_date' => "2022-06-15 14:45:00",
                'end_date' => "2022-06-16 14:45:00",
                'status' => true,
                'created_at' => \Illuminate\Support\Carbon::now('UTC')->toDateTimeString(),
                'updated_at' => \Illuminate\Support\Carbon::now('UTC')->toDateTimeString()
            ]
        ];
        DB::table('my_bl_campaigns')->insert($data);
    }
}
