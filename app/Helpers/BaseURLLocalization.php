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
            "app_service_en" =>  "TAKE_INTERNET_LOAN",
            "app_service_bn" =>  "BUY_INTERNET" ,

            // Business Packages
            "business_packages_en" =>  "packages",
            "business_packages_bn" =>  "packages" ,

            // Business Packages
            "business_internet_en" =>  "internet",
            "business_internet_bn" =>  "internet" ,

            // Business Solution
            "business_solution_en" =>  "business-solution",
            "business_solution_bn" =>  "business-solution" ,

            // Blogs
            "blog_en" =>  "blogs",
            "blog_bn" =>  "blogs" ,
        ];
    }
}
