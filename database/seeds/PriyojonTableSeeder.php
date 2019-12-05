<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Priyojon;
use App\Models\AboutPriyojon;

class PriyojonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priyojonLandingData = [
            [
                'parent_id' => 0,
                'title_en' => "Life style benefits",
                'title_bn' => "লাইফ স্টাইলের উপকার হয়",
            ],

            [
                'parent_id' => 0,
                'title_en' => "Reward Points",
                'title_bn' => "পুরস্কার পয়েন্ট",
            ]
        ];

        DB::table('priyojons')->insert($priyojonLandingData);

        $subMenuEn = ['About Priojon', 'Partners', 'Benefits',];
        $subMenuBn = ['প্রিজোন সম্পর্কে', 'অংশীদার', 'সুবিধা',];

        foreach ($subMenuEn as $key => $value) {
            Priyojon::create([
                'parent_id' => 1,
                'title_en' => $value,
                'title_bn' => $subMenuBn[$key],
            ]);
        }

        $subMenuEn = ['About', 'Redeem Point'];
        $subMenuBn = ['সম্পর্কে', 'রিডিম পয়েন্ট'];

        foreach ($subMenuEn as $key => $value) {
            Priyojon::create([
                'parent_id' => 2,
                'title_en' => $value,
                'title_bn' => $subMenuBn[$key],
            ]);
        }

        AboutPriyojon::create([
            'details_en' => "<h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 600; font-stretch: inherit; font-size: 24px; line-height: 31.2px; font-family: Nunito, sans-serif; vertical-align: baseline; letter-spacing: -0.04em; text-transform: capitalize; color: rgb(63, 71, 84);\">What Is Priyojon?</h1><p class=\"priyojon_about_desc\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; line-height: 24px; font-family: Nunito, sans-serif; vertical-align: baseline; text-transform: capitalize; color: rgb(63, 71, 84);\">Priyojon Is A Loyalty Based Platform Where Customers Receive Privileges And Exciting Offers For Being A Valuable Banglalink Customer. Without Any Additional Registration You Can Be Entitled To Different Tiers Of Priyojon Considering Average Usage Of The Last 3 Months.</p><h2 class=\"priyojon_discount_subtitle\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 600; font-stretch: inherit; font-size: 18px; line-height: 25px; font-family: Nunito, sans-serif; vertical-align: baseline; letter-spacing: -0.04em; color: rgb(63, 71, 84);\">Banglalink Subscriber can check the status:</h2><div class=\"row clearfix code_table\" style=\"box-sizing: inherit; margin: 0.9375rem -0.625rem 4.375rem; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: Nunito, sans-serif; vertical-align: baseline; overflow: auto; color: rgb(63, 71, 84);\"><div class=\"columns large-3 small-12\" style=\"box-sizing: inherit; margin: 0px 0px 1.25rem; padding: 0px 0.625rem; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 285px;\"><p class=\"discount_head\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0.625rem; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; line-height: 22px; font-family: inherit; vertical-align: baseline; text-transform: capitalize;\">USSD</p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 1rem; line-height: 1.375rem; font-family: inherit; vertical-align: baseline;\">Dial *124*2#</p></div><div class=\"columns large-4 small-12\" style=\"box-sizing: inherit; margin: 0px 0px 1.25rem; padding: 0px 0.625rem; border: 0px; font: inherit; vertical-align: baseline; float: left; width: 379.983px;\"><p class=\"discount_head\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0.625rem; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; line-height: 22px; font-family: inherit; vertical-align: baseline; text-transform: capitalize;\">SMS</p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 1rem; line-height: 1.375rem; font-family: inherit; vertical-align: baseline;\">SMS Type priyojon &amp; send to 29000 (FREE)</p></div></div><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 600; font-stretch: inherit; font-size: 24px; line-height: 31.2px; font-family: Nunito, sans-serif; vertical-align: baseline; letter-spacing: -0.04em; text-transform: capitalize; color: rgb(63, 71, 84);\">How Can Be A Priyojon?</h1><p class=\"priyojon_about_desc\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; line-height: 24px; font-family: Nunito, sans-serif; vertical-align: baseline; text-transform: capitalize; color: rgb(63, 71, 84);\">Priyojon Is A Loyalty Based Platform Where Customers Receive Privileges And Exciting Offers For Being A Valuable Banglalink Customer. Without Any Additional Registration You Can Be Entitled To Different Tiers Of Priyojon Considering Average Usage Of The Last 3 Months.</p>",
            'details_bn' => "<h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><span>﻿</span><span style=\"font-size: 18px;\">﻿</span><span style=\"font-size: 18px;\">﻿</span><span style=\"font-size: 18px;\">﻿</span><span style=\"font-size: 18px;\">﻿</span><font color=\"#3f4754\" face=\"Nunito, sans-serif\"><span style=\"font-size: 18px; letter-spacing: -0.96px; text-transform: capitalize;\"><b>প্রিয়জন কী?</b></span></font></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><font color=\"#3f4754\" face=\"Nunito, sans-serif\"><span style=\"font-size: 12px; letter-spacing: -0.96px; text-transform: capitalize;\">প্রিয়জন একটি আনুগত্য ভিত্তিক প্ল্যাটফর্ম যেখানে গ্রাহকরা মূল্যবান বাংলালিংক গ্রাহক হওয়ার জন্য বিশেষাধিকার এবং উত্তেজনাপূর্ণ অফার পান। কোনও অতিরিক্ত রেজিস্ট্রেশন ছাড়াই আপনাকে গত 3 মাসের গড় ব্যবহার বিবেচনা করে প্রিয়জন বিভিন্ন স্তরে নিয়োগ দেওয়া যেতে পারে।</span></font></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><span style=\"font-size: 18px;\"><b>বাংলালিংক গ্রাহক স্থিতিটি পরীক্ষা করতে পারেন:</b></span></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><b><font color=\"#3f4754\" face=\"Nunito, sans-serif\"><span style=\"font-size: 14px; letter-spacing: -0.96px; text-transform: capitalize;\">ইউএসএসডি&nbsp;</span></font><span style=\"font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"font-size: 14px;\">&nbsp;&nbsp;&nbsp;&nbsp;</span></b>&nbsp; &nbsp; &nbsp;&nbsp;<b><span style=\"font-size: 14px;\">খুদেবার্তা</span></b></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><span style=\"font-size: 14px; letter-spacing: -0.96px; text-transform: capitalize; color: rgb(63, 71, 84); font-family: Nunito, sans-serif;\">* 124 * 2 # ডায়াল করুন&nbsp;</span><span style=\"font-size: 14px;\">&nbsp; &nbsp; &nbsp; &nbsp; </span><span style=\"font-size: 14px;\">প্রিমোজোন এসএমএসের প্রকার লিখে 29000 নম্বরে (বিনামূল্যে) প্রেরণ করুন</span><br></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><span style=\"color: rgb(63, 71, 84); font-family: Nunito, sans-serif; font-size: 18px; letter-spacing: -0.96px; text-transform: capitalize;\"><b>প্রিয়জন কীভাবে হতে পারে?</b></span><br></h1><h1 class=\"priyojon_about_title\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.25rem; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 31.2px; vertical-align: baseline;\"><font color=\"#3f4754\" face=\"Nunito, sans-serif\"><span style=\"font-size: 12px; letter-spacing: -0.96px; text-transform: capitalize;\">প্রিয়জন একটি আনুগত্য ভিত্তিক প্ল্যাটফর্ম যেখানে গ্রাহকরা মূল্যবান বাংলালিংক গ্রাহক হওয়ার জন্য বিশেষাধিকার এবং উত্তেজনাপূর্ণ অফার পান। কোনও অতিরিক্ত রেজিস্ট্রেশন ছাড়াই আপনাকে গত 3 মাসের গড় ব্যবহার বিবেচনা করে প্রিয়জন বিভিন্ন স্তরে নিয়োগ দেওয়া যেতে পারে।</span></font></h1>",
            'left_side_img' => "images/about-priyojon/about-placeholder.png",
            'right_side_ing' => "images/about-priyojon/about-placeholder.png",
        ]);
    }
}
