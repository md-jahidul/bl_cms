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
                'title' => 'MIX OFFER 1',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  15,
                'price' => 299,
                'offer_code' => "MIX_OFF_1",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => 'MIX OFFER 2',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 399,
                'offer_code' => "MIX_OFF_2",
                'tag' => "Exclusive",
                'points' => 152
            ],
            [
                'title' => 'MIX OFFER 3',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 499,
                'offer_code' => "MIX_OFF_3",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => 'MIX OFFER 4',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 699,
                'offer_code' => "MIX_OFF_4",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => 'MIX OFFER 5',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 999,
                'offer_code' => "MIX_OFF_5",
                'tag' => "Exclusive",
                'points' => 152
            ]
        ];
        DB::table('mixed_bundle_offers')->insert($offers);
    }
}
