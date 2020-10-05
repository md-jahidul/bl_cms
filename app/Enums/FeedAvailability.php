<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FeedAvailability extends Enum
{
    public const GUEST =   "guest";
    public const PREPAID =   "prepaid";
    public const POSTPAID =   "postpaid";
}
