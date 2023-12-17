<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class GlobalSettingConst extends Enum
{
    public const SETTINGS_REDIS_KEY =   "settings_file_map";
    public const JSON = "json";
    public const INT = "number";
    public const BOOL = "boolean";
}
