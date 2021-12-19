<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CustomerActivityType extends Enum
{
    public const GUEST = "guest";
    public const LOGIN = "login";
    public const LOGOUT = "logout";
}
