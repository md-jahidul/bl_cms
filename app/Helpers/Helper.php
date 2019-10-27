<?php

namespace App\Helpers;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }


    /**
     * Contextual action list
     * @return array
     */
    public static function contextualCardActionList()
    {

        $list = [
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
            "BACKUP_CONTACT" => "BACKUP_CONTACT",
            "VAS" => "VAS",
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
            "UPDATE" =>  "UPDATE"

        ];

        return $list;
    }
}
