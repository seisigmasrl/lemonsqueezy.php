<?php

declare(strict_types=1);

namespace LemonSqueezy\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use LemonSqueezy\Exception\ApiLimitExceededException;
use LemonSqueezy\Exception\CannotProcessRecordException;
use LemonSqueezy\Exception\ExceptionInterface;
use LemonSqueezy\Exception\HiddenRecordException;
use LemonSqueezy\Exception\InvalidMethodException;
use LemonSqueezy\Exception\ResourceNotFoundException;
use LemonSqueezy\Exception\RuntimeException;
use LemonSqueezy\Exception\UnauthorizedPermissionException;
use LemonSqueezy\Exception\ValidationFailedException;
use LemonSqueezy\HttpClient\Message\ResponseMediator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ExceptionThrower implements Plugin
{
    /**
     * @throws ExceptionInterface
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response): ResponseInterface {
            $status = $response->getStatusCode();

            if ($status >= 400 && $status < 600) {
                throw self::createException($status, ResponseMediator::getErrorMessage($response) ?? $response->getReasonPhrase());
            }

            return $response;
        });
    }

    private static function createException(int $status, string $message): ExceptionInterface
    {
        return match ($status) {
            400 => new ValidationFailedException($message, $status),
            401 => new UnauthorizedPermissionException($message, $status),
            403 => new HiddenRecordException($message, $status),
            404 => new ResourceNotFoundException($message, $status),
            405 => new InvalidMethodException($message, $status),
            422 => new CannotProcessRecordException($message, $status),
            429 => new ApiLimitExceededException($message, $status),
            default => new RuntimeException($message, $status),
        };
    }
}
