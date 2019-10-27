<?php

use App\Models\PartnerOffer;
use Illuminate\Database\Seeder;

class PartnerOfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $validityEn = ["Vaild till 8 March 2019", "Vaild till 10 April 2019", "Vaild till 29 May 2019"];
        $validityBn = ["8 ই মার্চ 2019 অবধি বৈধ", "10 এপ্রিল 2019 পর্যন্ত বৈধ", "29 মে 2019 অবধি বৈধ"];
        $offerEn = ["Upto 15% Discount","Upto 20% Discount","Upto 25% Discount"];
        $offerBn = ["১৫% ছাড় পর্যন্ত","২০% ছাড় পর্যন্ত","২৫% ছাড় পর্যন্ত"];
        $getOfferMsgEn = "Type 8497 send SMS to 1020";
        $getOfferMsgBn = "৮৪৯৭ টাইপ করুন ১০২০ নম্বরে এসএমএস পাঠান";
        $countHomePageOffer = 0;
        for ($i = 0; $i < 30; $i++) {
            $randItem = rand(0, 2);
            $showInHome = rand(0, 3) ? 1 : 0;

            $displayOrder = $showInHome ? ++$countHomePageOffer : 0;
            PartnerOffer::create([
                'partner_id' => rand(1, 5),
                'validity_en' => $validityEn[$randItem],
                'validity_bn' => $validityBn[$randItem],
                'offer_en' => $offerEn[$randItem],
                'offer_bn' => $offerBn[$randItem],
                'get_offer_msg_en' => $getOfferMsgEn,
                'get_offer_msg_bn' => $getOfferMsgBn,
                'btn_text_en' => 'View Details',
                'btn_text_bn' => 'বিস্তারিত দেখুন',
                'show_in_home' => $showInHome,
                'is_active' => rand(0, 6) ? 1 : 0,
                'display_order' => $displayOrder,
                'other_attributes' => json_encode(null),
            ]);
        }
    }
}
