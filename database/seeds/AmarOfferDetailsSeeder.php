<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmarOfferDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amar_offer_details')->truncate();
        $detailsEn = '<ul><li style="box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 69, 90); position: relative;">All prepaid and Call &amp; Control subscribers will be eligible for this bundle</li><li style="box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 69, 90); position: relative;">this bundle This bundle can be purchased by Recharging exactly Tk.193 or by dialing *166*193#</li><li style="box-sizing: inherit; margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; color: rgb(51, 69, 90); position: relative;">After completion of bundle internet volume or validity, customer shall be charged at Pay-As-You-Go rate of 1TK/MB (inclusive of VAT, Supplementary Duty and Surcharge) with 10KB pulse</li></ul>';
        $detailsBn = '<ul><li>সমস্ত প্রিপেইড এবং কল এবং কন্ট্রোল গ্রাহকগণ এই বান্ডিলের জন্য যোগ্য হতে হবে</li><li>এই বান্ডিলটি ঠিক ১১৯ টাকার রিচার্জ করে বা * 166 * 193 # ডায়াল করে এই বান্ডেলটি কেনা যাবে</li><li>বান্ডিল ইন্টারনেট ভলিউম বা বৈধতা সমাপ্তির পরে, গ্রাহককে 1 কে / এমবি (ভ্যাট, পরিপূরক শুল্ক এবং সারচার্জ সহ) 10 কেবি নাড়ি সহ পে-অ্যাস-ইউ-গো হারে চার্জ নেওয়া হবে</li></ul>';
        $offerType = ['data', 'voice', 'mix'];

        foreach ($offerType as $item) {
            DB::table('amar_offer_details')->insert([
                'details_en' => $detailsEn,
                'details_bn' => $detailsBn,
                'type' => $item
            ]);
        }
    }
}
