<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class InvalidMethodException extends ErrorException
{
    protected $message = 'The method you are trying to access is invalid.';
}
