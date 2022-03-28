<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ModelActions extends Enum
{
    public const C =   'CREATE';
    public const R =   'READ';
    public const U =   'UPDATE';
    public const D =   'DELETE';
}
