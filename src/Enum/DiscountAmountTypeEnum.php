<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum DiscountAmountTypeEnum: string
{
    case FIXED = 'fixed';
    case PERCENT = 'percent';
}
