<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class ValidationFailedException extends ErrorException
{
    protected $message = 'Please review your request.';
}
