<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MixedBundleOfferSeeder extends Seeder
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
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  15,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer"
            ],

            [
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive"
            ],

            [
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer"
            ],

            [
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer"
            ],

            [
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive"
            ],

            [
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive"
            ]
        ];

        DB::table('mixed_bundle_offers')->insert($offers);
    }
}
