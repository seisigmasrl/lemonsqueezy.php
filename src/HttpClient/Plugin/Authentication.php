<?php

declare(strict_types=1);

namespace LemonSqueezy\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

use function sprintf;

final class Authentication implements Plugin
{
    private string $header;

    public function __construct(string $apiKey)
    {
        $this->header = sprintf('Bearer %s', $apiKey);
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $request = $request->withHeader('Authorization', $this->header);

        return $next($request);
    }
}
