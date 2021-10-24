<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EventBasedAnalyticTypes extends Enum
{
    public const CAMPAIGN =   "campaign";
    public const CHALLENGE =   "challenge";
    public const TASK =   "task";
    public const MSISDN =   "msisdn";
}
