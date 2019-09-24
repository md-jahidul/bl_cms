<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InternetOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offers = [[
            'volume' => 250.00,
            'validity' => 10,
            'price' => 120.00,
            'offer_code' => "IN250"
        ],

            [
                'volume' => 1024.00,
                'validity' => 30,
                'price' => 320.00,
                'offer_code' => "IN1GB"
            ]
        ];

        DB::table('internet_offers')->insert($offers);
    }
}
