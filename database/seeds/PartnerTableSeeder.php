<?php

use App\Models\Partner;
use Illuminate\Database\Seeder;

use App\Models\PartnerOffer;

class PartnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Partner::truncate();

        $companyNameEn =  ['Sheraton','Burger King','Labaid', 'Patho', 'Aarong'];
        $companyNameBn =  ['শেরাটন', 'বার্গার কিং', 'ল্যাবাইড', 'পাঠো', 'আড়ং'];
        $companyLogo =    ['logo-sheraton.png','logo-buger-king.png','logo-labaid.png','logo-patho.png','logo-aarong.png'];
        $companyAddress = "Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $companyWebSite = ['sheraton.marriott.com','burger-king.com','labaid.com', 'patho.com', 'aarong.com'];
        $contactPersonName = "Shafiq Ahamad";
        // $contactPersonEmail = "banglaling@bl.net";
        $contactPersonMobile = "0191955522";


        foreach ($companyNameEn as $key => $value) {
            Partner::create([
                'partner_category_id' => $key + 1,
                'company_name_en' => $value,
                'company_name_bn' => $companyNameBn[$key],
                'company_logo' => 'assetlite/images/partners-logo/' . $companyLogo[$key],
                'company_address' => $companyAddress,
                'company_website' => 'https://' . $companyWebSite[$key],
                'contact_person_name' => $contactPersonName,
                'contact_person_email' =>  str_replace(" ", "", strtolower($value)) . '@gmail.com',
                'contact_person_mobile' => $contactPersonMobile . $key,
                'google_play_link' => "https://play.google.com/store/apps/details?id=com.arena.banglalinkmela.app",
                'apple_app_store_link' => "https://apps.apple.com/us/app/my-banglalink/id934133022",
                'other_attributes' => [],
            ]);
        }
    }
}
