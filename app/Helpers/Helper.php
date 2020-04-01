<?php

namespace App\Helpers;
use App\Models\Config;

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
            "DIAL"                    => "Dial",
            "INTERNET_DETAILS"        => "Balance details > Internet",
            "MINTUES_DETAILS"         => "Balance details > Minutes",
            "SMS_DETAILS"             => "Balance details > SMS",
            "FAQ"                     => "FAQ",
            "FNF"                     => "FnF",
            "HOME"                    => "Home Menu",
            "URL"                     => "External Link",
            "INTERNET_EXCLUSIVE_PACK" => "Internet packs > Buy Packs > Exclusive Pack",
            "INTERNET_MONTHLY_PACK"   => "Internet packs > Buy Packs > Monthly Pack",
            "INTERNET_POWER_PACK"     => "Internet packs > Buy Packs > Power Pack",
            "INTERNET_WEEKLY_PACK"    => "Internet packs > Buy Packs > Weekly Pack",
            "INTERNET_TRANSFER_PACK"  => "Internet packs > Transfer",
            "LODGE_COMPLAINT"         => "Lodge a complaint",
            "MANAGE"                  => "Manage",
            "MENU"                    => "Menu",
            "MIXED_BUNDLES"           => "Mixed Bundles",
            "NOTIFICATIONS"           => "Notifications",
            "PRIVACY_POLICY"          => "Privacy Policy",
            "PROFILE"                 => "Profile",
            "RECHARGE"                => "Recharge",
            "RECHARGE_HISTORY"        => "Recharge History",
            "RECHARGE_OFFERS"         => "Recharge Offers",
            "SIM_INFORMATION"         => "Sim Information",
            "SMS_PACKS"               => "SMS Packs",
            "SPECIAL_RATE_PACKS"      => "Special Call Rate Offers",
            "STORE"                   => "Store",
            "STORE_LOCATOR"           => "Store locator",
            "T&C"                     => "T&C",
            "USAGE_HISTORY"           => "Usage History",
            "USSD_CODE_LIST"          => "View USSD code",
            "VOICE_BUNDLE"            => "Voice Bundles"

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

}
