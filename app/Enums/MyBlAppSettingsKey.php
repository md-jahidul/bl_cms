<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class MyBlAppSettingsKey
 * @package App\Enums
 */
final class MyBlAppSettingsKey extends Enum
{
    public const LOAN_ELIGIBILITY_MIN_AMOUNT = "LOAN_ELIGIBILITY_MIN_AMOUNT";
    public const SHOW_RAMADAN_TIMING_IN_HOME = "SHOW_RAMADAN_TIMING_IN_HOME";
    public const USAGE_HISTORY_TTL_SECONDS = "USAGE_HISTORY_TTL_IN_SECONDS";
    public const NAJAT_CONTENTS_SETTINGS = "NAJAT_CONTENTS_SETTINGS";
    public const LODGE_COMPLAIN_SETTINGS = "LODGE_COMPLAIN_SETTINGS";
}
