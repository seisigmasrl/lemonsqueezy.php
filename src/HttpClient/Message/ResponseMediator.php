<?php

declare(strict_types=1);

namespace LemonSqueezy\HttpClient\Message;

use LemonSqueezy\Exception\RuntimeException;
use LemonSqueezy\HttpClient\Util\JsonObject;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use function str_starts_with;
use function sprintf;
use function is_string;
use function is_object;
use function array_filter;
use function get_object_vars;
use function is_null;
use function array_shift;

final class ResponseMediator
{
    public const CONTENT_TYPE_HEADER = 'Content-Type';
    public const JSON_CONTENT_TYPE = 'application/json';

    public static function getContent(ResponseInterface $response): stdClass
    {
        if (204 === $response->getStatusCode()) {
            return JsonObject::empty();
        }

        $body = (string) $response->getBody();

        if ('' === $body) {
            return JsonObject::empty();
        }

        if (! str_starts_with(self::getHeader($response, self::CONTENT_TYPE_HEADER) ?? '', self::JSON_CONTENT_TYPE)) {
            throw new RuntimeException(sprintf('The content type was not %s.', self::JSON_CONTENT_TYPE));
        }

        return JsonObject::decode($body);
    }

    public static function getErrorMessage(ResponseInterface $response): ?string
    {
        try {
            $content = self::getContent($response);
        } catch (RuntimeException $e) {
            return null;
        }

        return isset($content->message) && is_string($content->message) ? $content->message : null;
    }

    public static function getPagination(ResponseInterface $response): array
    {
        try {
            $content = self::getContent($response);
        } catch (RuntimeException $e) {
            return [];
        }

        if (! isset($content->links->pages) || ! is_object($content->links->pages)) {
            return [];
        }

        /** array<string,string> */
        return array_filter(get_object_vars($content->links->pages));
    }

    public static function getRateLimit(ResponseInterface $response): array
    {
        $limit = self::getHeader($response, 'X-Ratelimit-Limit');
        $remaining = self::getHeader($response, 'X-Ratelimit-Remaining');

        if (is_null($remaining) || is_null($limit)) {
            return [];
        }

        return [
            'remaining' => (int) $remaining,
            'limit' => (int) $limit,
        ];
    }

    private static function getHeader(ResponseInterface $response, string $name): ?string
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
