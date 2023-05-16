<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum DiscountStatusEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}
