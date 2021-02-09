<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PurchaseLog extends Enum
{
    public const ACTION_BUY_SUCCESS = 'buy_success';
    public const ACTION_BUY_FAILURE = 'buy_failure';
    public const ACTION_CANCEL = 'cancel';
    public const ACTION_POPUP_CANCEL = 'popup_cancel';
    public const ACTION_POPUP_CONTINUE = 'popup_continue';

    public const TYPE_SOURCE_DEEP_LINK = "deeplink_purchase";
    public const TYPE_SOURCE_AGENT_DEEP_LINK = "agent_deeplink_purchase";
    public const TYPE_SOURCE_NOTIFICATION = "notification_purchase";
    public const  TYPE_SOURCE_POPUP = "popup_purchase";
}
