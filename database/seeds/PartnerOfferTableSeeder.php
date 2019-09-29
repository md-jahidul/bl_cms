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
        $validityBn = ["8 ই মার্চ 2019 অবধি বৈধ", "10 এপ্রিল 2019 পর্যন্ত বৈধ", "29 মে 2019 অবধি বৈধ"];;
        $offerEn = ["15","20","25"];
        $offerBn = ["১৫","২০","২৫"];
        $getOfferMsgEn = "Type 8497 send SMS to 1020";
        $getOfferMsgBn = "৮৪৯৭ টাইপ করুন ১০২০ নম্বরে এসএমএস পাঠান";

        foreach ($validityEn as $key=>$value){
            PartnerOffer::create([
                'partner_id' => $key +1,
                'validity_en' => $value,
                'validity_bn' => $validityBn[$key],
                'offer_en' => $offerEn[$key],
                'offer_bn' => $offerBn[$key],
                'get_offer_msg_en' => $getOfferMsgEn,
                'get_offer_msg_bn' => $getOfferMsgBn,
                'btn_text_en' => 'View Details',
                'btn_text_bn' => 'বিস্তারিত দেখুন',
                'show_in_home' => 1,
                'is_active' => 1,
                'display_order' => $key +1,
                'other_attributes' => json_encode(null),
            ]);
        }
    }
}
