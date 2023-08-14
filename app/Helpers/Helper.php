<?php

namespace App\Helpers;

use App\Models\Config;
use Carbon\Carbon;

class Helper
{

    /**
     * Contextual action list
     * @return array
     */
    public static function contextualCardActionList()
    {

        return [
            "RECHARGE" =>  "RECHARGE",
            "RECHARGE_AMOUNT" =>  "RECHARGE_AMOUNT",
            "TAKE_LOAN" =>  "TAKE_LOAN",
            "TAKE_BALANCE_LOAN" =>  "TAKE_BALANCE_LOAN",
            "TAKE_INTERNET_LOAN" =>  "TAKE_INTERNET_LOAN",
            "BUY_INTERNET" =>  "BUY_INTERNET" ,
            "BUY_INTERNET_PLAN" =>  "BUY_INTERNET_PLAN",
            "BUY_AMAR_OFFER" =>  "BUY_AMAR_OFFER",
            "BUY_AMAR_OFFER_PLAN" =>   "BUY_AMAR_OFFER_PLAN",
            "BUY_MIXED_BUNDLE_OFFER" => "BUY_MIXED_BUNDLE_OFFER",
            "BUY_MIXED_BUNDLE_OFFER_PLAN" =>  "BUY_MIXED_BUNDLE_OFFER_PLAN",
            "AUTO_RENEWAL" => "AUTO_RENEWAL",
            "UPDATE_PROFILE" =>  "UPDATE_PROFILE",
            "ADD_FNF" => "ADD_FNF",
            "BACKUP" => "BACKUP",
            "BACKUP_CONTACT" => "BACKUP_CONTACT",
            "VAS" => "VAS",
            "SUBSCRIBE" =>  "SUBSCRIBE",
            "SUBSCRIBE_VAS" =>  "SUBSCRIBE_VAS",
            "COLLECT_POINT" =>  "COLLECT_POINT",
            "SUBSCRIVE_DIGITAL_SERVICE" =>  "SUBSCRIVE_DIGITAL_SERVICE",
            "INSTALL_APP" =>  "INSTALL_APP",
            "MASTER_KEY" => "MASTER_KEY",
            "AMAR_PLAN" => "AMAR_PLAN",
            "MIGRATE" =>  "MIGRATE",
            "INTERNET_CONFIGURATION" =>   "INTERNET_CONFIGURATION",
            "SWITCH_ACCOUNT" => "SWITCH_ACCOUNT",
            "SWITCH_LANGUAGE" =>  "SWITCH_LANGUAGE",
            "UPDATE" =>  "UPDATE",
            "CANCEL" =>  "CANCEL",
        ];
    }

    /**
     * Navigation action list
     * @return array
     */
    public static function navigationActionList()
    {
        return [
            "AMAR_OFFER"              => "Amar Offer",
            "BALANCE_DETAILS"         => "Balance details > Balance",
            "BALANCE_TRANSFER"        => "Balance Transfer",
            "CONTACT_BACKUP"          => "Contact Backup",
            "CHANGE_PASSWORD"         => "Change Password",
            "DIAL"                    => "Dial",
            "EXPORT_USAGE_HISTORY"    => "Export Usage History",
            "EMERGENCY_BALANCE"       => "Emergency Balance",
            "INTERNET_DETAILS"        => "Balance details > Internet",
            "MINTUES_DETAILS"         => "Balance details > Minutes",
            "SMS_DETAILS"             => "Balance details > SMS",
            "FAQ"                     => "FAQ",
            "FNF"                     => "FnF",
            "FEED"                    => "Feeds",
            "FEED_CATEGORY"           => "Feed Category",
            "FILTER_NOTIFICATION"     => "Filter Notification",
            "HOME"                    => "Home Menu",
            "HOME_ARRANGEMENT"        => "Home Arrangement",
            "URL"                     => "External Link",
            "INTERNET_PACKS"          => "Internet Packs",
            "INTERNET_CONFIGURATION"  => "Get Internet Configuration",
            "INTERNET_EXCLUSIVE_PACK" => "Internet packs > Buy Packs > Exclusive Pack",
            "INTERNET_MONTHLY_PACK"   => "Internet packs > Buy Packs > Monthly Pack",
            "INTERNET_POWER_PACK"     => "Internet packs > Buy Packs > Power Pack",
            "INTERNET_WEEKLY_PACK"    => "Internet packs > Buy Packs > Weekly Pack",
            "INTERNET_SOCIAL_PACK"    => "Internet packs > Buy Packs > Social Pack",
            "INTERNET_TRANSFER_PACK"  => "Internet packs > Transfer",
            "INTERNET_GIFT"           => "Internet Packs > Gift",
            "LODGE_COMPLAINT"         => "Lodge a complaint",
            "MANAGE"                  => "Manage",
            "MENU"                    => "Menu",
            "MIXED_BUNDLES"           => "Mixed Bundles",
            "MY_BILL"                 => "Postpaid MyBill",
            "NOTIFICATIONS"           => "Notifications",
            "PLANS"                   => "Plans",
            "CURRENT_PACKAGE_INFORMATION" => "Package Information",
            "PRIVACY_POLICY"          => "Privacy Policy",
            "PROFILE"                 => "Profile",
            "PURCHASE"                => "Purchase Product",
            "RECHARGE"                => "Recharge",
            "RECHARGE_HISTORY"        => "Recharge History",
            "RECHARGE_OFFERS"         => "Recharge Offers",
            "REPORT_PROBLEM"          => "Report Problem",
            "SIM_INFORMATION"         => "Sim Information",
            "SMS_PACKS"               => "SMS Packs",
            "SPECIAL_RATE_PACKS"      => "Special Call Rate Offers",
            "STORE"                   => "Store",
            "STORE_LOCATOR"           => "Store locator",
            "T&C"                     => "T&C",
            "USAGE_HISTORY"           => "Usage History",
            "USSD_CODE_LIST"          => "View USSD code",
            "VOICE_BUNDLE"            => "Voice Bundles",
            "4G_MAP"                  => "4G Map",
            "MIGRATE_PLAN"            => "Migrate Plan",
            "BONDHO_SIM_OFFER"        => "Bondho SIM Offer",
            "SWITCH_ACCOUNT"          => "Switch Account",
            "CHECK_FOR_UPDATES"       => "Check for updates",
            "REFER_AND_EARN"          => "Refer And Earn ",
            "LANGUAGE"                => "Language",
            "ORANGE_CLUB"             => "Orange Club",
            "STOP_ALL_VAS"            => "Stop All VAS",
            "4G_USIM_ELIGIBILITY"     => "4G USIM Eligibility",
            "MEDALIA_FEEDBACK"        => "Medalia Feedback",
            "EVENT_BASED_BONUS"       => "Event Based Bonus",
            "MYBL_CAMPAIGN"           => "MyBl Campaign Modality",
            "HELP_AND_TUTORIAL" => "Help & Tutorial",
            "CALL_CENTER" => "Call Center",
            "GAMES"                   => "Games",
            "MUSICS"                  => "Musics",
            "VIDEO"                   => "Video",
            "STORIES"                 => "Stories",
            "SHOP"                    => "Shop",
            "COURSES"                 => "Courses",
            "GIFT_PACKS"              => "Gift Packs",
            "ROAMING_PACKS"           => "Roaming Packs",
            "ROAMING_DETAILS"         => "Roaming Details",
            "USSD"                    => "USSD code",
            "CARE"                    => "Care",
            "COMMERCE"                => 'Commerce',
            "UTILITY"                 => 'Utility',
            "ELECTRICITY"             => 'Electricity',
            "GAS"                     => 'Gas',
            "WATER"                   => 'Water',
            "SHARETRIP"               => 'Sharetrip',
            "CONTENT"                 => 'Content',
            "RABBITHOLE"              => 'Rabbithole',
            "BUS"                     => 'Bus',
            "SUPPORT_EMAIL"           => 'Support Email',
            "SPIN_WHEEL"              => 'Spin Wheel',
            "COMMUNITY"               => 'Community',
            "TOFFEE"                  => 'Toffee',
            "TOFFEE_LIVE"             => 'Toffee_Live'
        ];
    }


    /**
     * @return string[]
     */
    public static function deepLinkList(): array
    {
        return [
            "amar_offers"                => "Amar Offer",
            "balance_details"            => "Balance details > Balance",
            "contact_backup"             => "Contact Backup",
            "change_password"            => "Change Password",
            "emergency_balance"          => "Emergency Balance",
            "fnf"                        => "FnF",
            "manage"                     => "Manage",
            "menu"                       => "Menu",
            "mixed_bundles"              => "Mixed Bundles",
            "privacy_policy"             => "Privacy Policy",
            "recharge_offers"            => "Recharge Offers",
            "store"                      => "Store",
            "store_locator"              => "Store locator",
            "usage_history"              => "Usage History",
            "4g_map"                     => "4G Map",
            "migrate_plan"               => "Migrate Plan",
            "bondho_sim_offer"           => "Bondho SIM Offer",
            "switch_account"             => "Switch Account",
            "refer_and_earn"             => "Refer And Earn",
            "call_center"                => "Call Center",
            "edit_profile"               => "Edit Profile",
            "frequently_asked_questions" => "FAQ",
            "home_rearrangement"         => "Home Rearrangement",
            "internet _configuration"    => "Home Rearrangement",
            "complaint_status"           => "Complaint Status",
            "new_complaint"              => "New Complaint",
            "notification_filter"        => "Notification Filter",
            "notification"               => "Notification",
            "notification_setting"       => "Notification Setting",
            "search"                     => "Search",
            "sim_info"                   => "SIM Info",
            "special_call_rate"          => "Special Call Rate",
            "switch_account/add_number"  => "Switch Account/Add Number",
            "terms_and_condition"        => "Terms And Condition",
            "ussd"                       => "USSD",
            "sms_packs"                  => "SMS Pack",
            "voice_packs"                => "Voice Bundle",
            "orange_club"                => "Orange Club",
            "4g_usim_eligibility"        => "4G USIM Eligibility",
            "recharge"                   => "Recharge",
            "help_and_tutorial"          => "Help & Tutorial",
            "check_for_updates"          => "Check For Updates",
            "games"                      => "Games",
            "musics"                     => "Musics",
            "video"                      => "Video",
            "stories"                    => "Stories",
            "shop"                       => "Shop",
            "courses"                    => "Courses"
        ];
    }



    /**
     * OTP Token length list
     *
     * @return array
     */
    public static function tokenLengthList()
    {
        return [
            "FOUR"   =>  4,
            "FIVE"   =>  5,
            "SIX"    =>  6,
            "SEVEN"  =>  7,
            "EIGHT"  =>  8
        ];

    }



    /**
     * OTP Token length list
     *
     * @return array
     */
    public static function migratePlanList()
    {

        return [
            "PlayPrepaid"             => "Banglalink Play",
            "DeshEkRateDarun"         => "Desh Ek Rate Darun",
            "Inspire9Postpaid"        => "Inspire9 Postpaid",
            "Retail2Postpaid"         => "PROpaid Package",
            "B2BPost60p10s"           => "Business Package 1",
            "B2BPreBusinessCnC4"      => "Business Prepaid Package 169",
        ];

    }


    /**
     * @param $start_date
     * @param $end_date
     */
    public static function formateDaterangeData($start_date, $end_date)
    {
        //dd($end_date);
        $s = Carbon::createFromFormat('Y-m-d H:i:s', trim($start_date))
            ->setTimezone('Asia/Dhaka')->format('Y/m/d h:i A');

        $e = Carbon::createFromFormat('Y-m-d H:i:s', trim($end_date))
            ->setTimezone('Asia/Dhaka')->format('Y/m/d h:i A');

        //dd($s . ' - ' . $e);
        return $s . ' - ' . $e;
    }

    public static function urlRedirectionForList()
    {
        return [
          'product' => 'Product',
          'dynamic_link' => 'Dynamic Link',
          'content' => 'Content',
          'others' => 'Others'
        ];
    }

    public static function campaignType()
    {
        return [
            'recharge' => 'Recharge',
            'pack_purchase' => 'Pack Purchase',
        ];
    }

    public static function productCategories()
    {
        return [
            'data' => 'DATA',
            'mix' => 'MIX BUNDLES',
            'voice' => 'VOICE BUNDLES',
            'sms' => 'SMS BUNDLES',
            'scr' => 'SPECIAL CALL RATE',
            'recharge_offer' => 'RECHARGE OFFER',
            'ma loan' => 'MA LOAN',
            'data loan' => 'DATA LOAN',
            'gift' => 'GIFT',
            'volume request' => 'VOLUME REQUEST',
            'volume transfer' => 'VOLUME TRANSFER'
        ];
    }


    public static function productType()
    {
        return [
            'internet_pack' => 'DATA',
            'voice' => 'VOICE',
            'mixed_bundle' => 'MIX BUNDLES',
            'gift_packs' => "GIFT PACKS",
            'roaming' => "ROAMING"
        ];
    }

    public static function guestUserActivityList(): array
    {
        return [
           'landing_page' => 'Landing Page',
           'otp_page' => 'OTP Page',
           'otp_send' => 'OTP Send',
           'password_login' => 'Password Login',
           'password_page' => 'Password Page',
           'logged_in' => 'Logged In',
           'forget_password_page' => 'Forget Password Page',
           'forget_password_send_otp' => 'Forget Password Send OTP',
           'set_new_password_page' => 'Set New Password Page',
           'change_password' => 'Change Password',
           'register_page' => 'Register Page',
           'send_otp_register' => 'Send OTP Register',
           'register_set_new_password_page' => 'Register Set New Password Page',
           'register_password_set' => 'Register Password Set',
           'number_verification' => 'Number Verification'
        ];
    }
}
