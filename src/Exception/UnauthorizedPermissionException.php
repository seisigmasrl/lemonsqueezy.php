<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class UnauthorizedPermissionException extends ErrorException
{
    protected $message = 'Please check you API key or your if you have access to this resource.';
}
