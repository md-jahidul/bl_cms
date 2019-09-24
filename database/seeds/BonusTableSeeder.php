<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = [[
            'internet_offer_id' => 1,
            'volume' => 250.00,
            'type' => "Internet",
            'title' => "Social Pack"
        ],

            [
                'internet_offer_id' => 1,
                'volume' => 120.00,
                'type' => "Talk time",
                'title' => "Off net"
            ]
        ];

        DB::table('bonus')->insert($offers);
    }
}
