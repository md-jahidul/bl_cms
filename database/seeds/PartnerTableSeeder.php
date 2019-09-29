<?php

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyNameEn =  ['Burger King','Labaid', 'Aarong'];
        $companyNameBn =  ['বার্গার কিং', 'ল্যাবাইদ', 'আড়ং'];
        $companyLogo =    ['logo-buger-king.png','labaid_logo.png','arong_logo.png'];
        $companyAddress = "Tiger’s Den, House 4 (SW), Bir Uttam Mir Shawkat Sarak, Gulshan1, Dhaka 1212.";
        $companyWebSite = ['burgerking.com','labaid.com', 'aarong.com'];
        $contactPersonName = "Shafiq Ahamad";
        $contactPersonEmail = "banglaling@bl.net";
        $contactPersonMobile = "01919555222";

        foreach ($companyNameEn as $key => $value){
            Partner::create([
                'partner_category_id' => $key + 1,
                'company_name_en' => $value,
                'company_name_bn' => $companyNameBn[$key],
                'company_logo' => env('APP_URL', 'http://localhost:8000'). '/images/partners-logo/' . $companyLogo[$key],
                'company_address' => $companyAddress,
                'company_website' => $companyWebSite[$key],
                'contact_person_name' => $contactPersonName,
                'contact_person_email' => $contactPersonEmail,
                'contact_person_mobile' => $contactPersonMobile,
                'other_attributes' => [],
            ]);
        }
    }
}
