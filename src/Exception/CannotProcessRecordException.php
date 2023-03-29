<?php

declare(strict_types=1);

namespace LemonSqueezy\Exception;

class CannotProcessRecordException extends RuntimeException
{
    protected $message = 'The requested method cannot process the record.';
}
