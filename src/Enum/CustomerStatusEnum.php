<?php

declare(strict_types=1);

namespace LemonSqueezy\Enum;

enum CustomerStatusEnum: string
{
    case SUBSCRIBED = 'subscribed';
    case UNSUBSCRIBED = 'unsubscribed';
    case ARCHIVED = 'archived';
    case UNVERIFIED = 'requires_verification';
    case INVALID = 'invalid_email';
    case BOUNCED = 'bounced';
}
