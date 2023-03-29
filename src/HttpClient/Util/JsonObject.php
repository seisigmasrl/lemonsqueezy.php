<?php

declare(strict_types=1);

namespace LemonSqueezy\HttpClient\Util;

use function get_debug_type;
use function json_decode;
use function json_encode;

use const JSON_ERROR_NONE;

use function json_last_error;

use function json_last_error_msg;

use LemonSqueezy\Exception\RuntimeException;

use function sprintf;

use stdClass;

final class JsonObject
{
    public static function empty(): stdClass
    {
        return new stdClass();
    }

    public static function decode(string $json): stdClass
    {
        $data = json_decode($json);

        if (JSON_ERROR_NONE != json_last_error()) {
            throw new RuntimeException(sprintf('json_decode error: %s', json_last_error_msg()));
        }

        if (! $data instanceof stdClass) {
            throw new RuntimeException(sprintf('json_decode error: Expected JSON of type object, %s given.', get_debug_type($data)));
        }

        return $data;
    }

    public static function encode(array $value): string
    {
        $json = json_encode($value);

        if (JSON_ERROR_NONE != json_last_error()) {
            throw new RuntimeException(sprintf('json_encode error: %s', json_last_error_msg()));
        }

        return $json;
    }
}
