<?php

namespace App\Helpers;

use App\Models\BaseMsisdn;
use App\Models\BaseMsisdnGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BaseURLLocalization
{

    public static function featureBaseUrl(): array
    {
        return [
            // Offer Prepaid
            "prepaid_en" =>  "prepaid",
            "prepaid_bn" =>  "prepaid",

            // Offer Postpaid
            "postpaid_en" =>  "postpaid",
            "postpaid_bn" =>  "postpaid",

            // App Service
            "app_service_en" =>  "apps-and-services",
            "app_service_bn" =>  "apps-and-services" ,

            // Business Packages
            "business_en" =>  "business",
            "business_bn" =>  "business" ,

            // Blogs
            "blog_en" =>  "blogs",
            "blog_bn" =>  "blogs" ,

            // CSR
            "csr_en" =>  "corporate-social-responsibility",
            "csr_bn" =>  "corporate-social-responsibility" ,

            // Loyalty Offer Details
            "partner_offer_details_en" => "loyalty/life-style/discount-privilege",
            "partner_offer_details_bn" => "loyalty/life-style/discount-privilege",

            // About Loyalty
            "about_loyalty_en" => "loyalty/life-style",
            "about_loyalty_bn" => "loyalty/life-style",

            // Explore C
            "explore_c_en" => "explore-c",
            "explore_c_bn" => "explore-c",

            // Roaming Offer
            "roaming_en" => "roaming",
            "roaming_bn" => "roaming",

            // Banglalink 4G
            "bl_4g_en" => "banglalink-4g",
            "bl_4g_bn" => "banglalink-4g",

            // Banglalink 4G
            "ethics-compliance_en" => "ethics-compliance",
            "ethics-compliance_bn" => "ethics-compliance"
        ];
    }
}