<?php

use App\Models\PartnerOffer;
use App\Models\PartnerOfferDetail;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PartnerOffer::truncate();
        PartnerOfferDetail::truncate();

        $validityEn = ["Vaild till 8 March 2019", "Vaild till 10 April 2019", "Vaild till 29 May 2019"];
        $validityBn = ["8 ই মার্চ 2019 অবধি বৈধ", "10 এপ্রিল 2019 পর্যন্ত বৈধ", "29 মে 2019 অবধি বৈধ"];
        $offerValue = [10, 15, 20, 25];

        $getOfferMsgEn = "Type 8497 send SMS to 1020";
        $getOfferMsgBn = "৮৪৯৭ টাইপ করুন ১০২০ নম্বরে এসএমএস পাঠান";
        $countHomePageOffer = 0;

        $detailsEn = "Life will be much easier now, because Banglalink is introducing balance transfer service! Easily transfer credit to your friends and family who use Banglalink number, anytime you want.";
        $detailsBn = 'জীবন এখন অনেক সহজ হবে, কারণ বাংলালিংক চালু করছে ব্যালান্স ট্রান্সফার সার্ভিস! আপনার পছন্দসই যে কোনও সময় বাংলালিংক নম্বর ব্যবহার করা আপনার বন্ধু এবং পরিবারের কাছে সহজেই ক্রেডিট স্থানান্তর করুন।';
        $offerDetailsEn = '<ul><li>10% flat discount on any Zantrik service</li><li>25% discount on Zantrik membership card for Icon, Signature and Platinum</li></ul>';
        $offerDetailsBn = '<ul><li>যান্ত্রিক যে কোনও পরিষেবাতে 10% ফ্ল্যাট ছাড় discount</li><li>আইকন, স্বাক্ষর এবং প্ল্যাটিনামের জন্য জান্ত্র্রিক সদস্যপদ কার্ডে 25% ছাড</li></ul>';
        $eligibleCoustomerEn = "Silver, Gold & Platium";
        $eligibleCoustomerBn = "সিলভার, সোনার ও প্লাটিয়াম";


        for ($i = 0; $i < 30; $i++) {
            $randItem = rand(0, 2);
            $showInHome = rand(0, 3) ? 1 : 0;
            $randSMS = rand(2000, 2100);
            $displayOrder = $showInHome ? ++$countHomePageOffer : 0;

            $partner = PartnerOffer::create([
                'partner_id' => rand(1, 5),
                'product_code' => strtoupper(uniqid()),
                'validity_en' => $validityEn[$randItem],
                'validity_bn' => $validityBn[$randItem],
                'start_date' => "2019-12-10 20:52:54",
                'offer_scale' => "Upto",
                'offer_value' => $offerValue[$randItem],
                'offer_unit' => "Percentage",
                'get_offer_msg_en' => $getOfferMsgEn,
                'get_offer_msg_bn' => $getOfferMsgBn,
                'btn_text_en' => 'View Details',
                'btn_text_bn' => 'বিস্তারিত দেখুন',
                'show_in_home' => $showInHome,
                'is_active' => rand(0, 6) ? 1 : 0,
                'display_order' => $displayOrder,
                'other_attributes' => json_encode(null),
            ]);

            PartnerOfferDetail::create([
                'partner_offer_id' => $partner->id,
                'details_en' => $detailsEn,
                'details_bn' => $detailsBn,
                'offer_details_en'   => $offerDetailsEn,
                'offer_details_bn'   => $offerDetailsBn,
                'eligible_customer_en'   => $eligibleCoustomerEn,
                'eligible_customer_bn'   => $eligibleCoustomerBn,
                'avail_en'   => "Type SARAH And Send An SMS To $randSMS",
                'avail_bn'   => "সারাহ টাইপ করুন এবং $randSMS এ একটি এসএমএস প্রেরণ করুন",
            ]);
        }
    }
}
