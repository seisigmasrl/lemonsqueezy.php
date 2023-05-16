<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum DiscountDurationEnum: string
{
    case ONCE = 'once';
    case REPEATING = 'repeating';
    case FOREVER = 'forever';
}
