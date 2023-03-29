<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class HiddenRecordException extends ErrorException
{
    protected $message = 'The requested record is hidden.';
}
