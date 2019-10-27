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
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  15,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive",
                'points' => 152
            ],
            [
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  10,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Hot Offer",
                'points' => 152
            ],
            [
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' =>  30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive",
                'points' => 152
            ],
            [
                'title' => '250MNN',
                'internet' => 999,
                'minutes' => 250,
                'sms' => 250,
                'validity' => 30,
                'price' => 999,
                'offer_code' => "MX999",
                'tag' => "Exclusive",
                'points' => 152
            ]
        ];
        DB::table('mixed_bundle_offers')->insert($offers);
    }
}
