<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrentBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = [
            [
                'balance' => "9.50",
                'validity' => "valid till 18 June 2020",
                'minutes_volume' => "69 Min",
                'minutes_validity' => "12D:21H:34M Left",
                'sms_volume' => "89 SMS",
                'sms_validity' => "12D:21H:34M Left",
                'internet_volume' => "09 GB",
                'internet_validity' => "12D:21H:34M Left"
            ]
        ];

        DB::table('current_balances')->insert($offers);
    }
}
