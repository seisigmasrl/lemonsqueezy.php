<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class ResourceNotFoundException extends RuntimeException
{
    protected $message = 'The record you are looking it doesn\'t exist.';
}
