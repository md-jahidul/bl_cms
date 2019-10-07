<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContextualCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = [
            [
            "title" => "Low Internet Balance",
            "description"=> "Buy internet packages to enjoy uninterrupted internet.",
            "first_action_text"=> "Get 30 MB",
            "second_action_text"=> "Buy Internet",
            "first_action"=> "recharge",
            "second_action"=> "emergency_balance",
            "image_url"=> "https://url.com"
        ],
            [

            "title"=> "Auto Renewal",
            "description"=> "Please recharge Tk.100 to renew your 1GB Bundle, valid for 15 days.",
            "first_action_text"=> "Tk. 100",
            "second_action_text"=> "May be later",
            "first_action"=> "recharge",
            "second_action"=> "cancel",
            "image_url"=> "https://url.com"
        ]

        ];

        DB::table('contextual_cards')->insert($cards);
    }
}
