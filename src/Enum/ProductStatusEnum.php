<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum ProductStatusEnum: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case PENDING = 'pending';
}
