<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class ApiLimitExceededException extends RuntimeException
{
    protected $message = 'You have exceeded the 300 API calls per minute.';
}
