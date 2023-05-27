<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum DiscountStatusEnum: string
{
    case PENDING = 'pending'; // the docs say that "pending" does not exist, but I saw it in an invalid discount
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}
