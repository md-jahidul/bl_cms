<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class FeedSource
 * @package App\Enums
 */
final class FeedSource extends Enum
{
    public const FACEBOOK = 'FACEBOOK';
    public const YOUTUBE  = 'YOUTUBE';
    public const CUSTOM   = 'CUSTOM';
}
