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

        return $list;
    }


    /**
     * OTP Token length list
     *
     * @return array
     */
    public static function tokenLengthList()
    {
        $list = [
            "FOUR"   =>  4,
            "FIVE"   =>  5,
            "SIX"    =>  6,
            "SEVEN"  =>  7,
            "EIGHT"  =>  8
        ];

        return $list;
    }

    /**
     * Get image upload size form config table
     * @return [number] [Image size in KB]
     */
    public static function getImageUploadSize(){

        $config_key = Config::where('key', '=', 'image_upload_size')->first();

        if( !empty($config_key) ){
            $file_size = ((int)$config_key->value * 1024);
            return $file_size;
        }
        else{
            return null;
        }

    }

    /**
     * [Image upload type]
     * @return [mixed] [description]
     */
    public static function getimageUploadType($type_array = false){

        $config_key = Config::where('key', '=', 'image_upload_type')->first();

        if( !empty($config_key) ){

            $type_list = unserialize($config_key->value);

            if( $type_array == false ){
                return implode(',', $type_list);
            }
            else{
                return $type_list;
            }
        }
        else{
            return '';
        }

    }

}
