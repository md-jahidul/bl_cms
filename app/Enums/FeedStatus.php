<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class FeedStatus
 * @package App\Enums
 */
final class FeedStatus extends Enum
{
    public const PENDING     = 'pending';
    public const APPROVED    = 'approved';
    public const DEACTIVATE  = 'deactivate';
}
