<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_merge;

use Http\Client\Exception;

use function is_null;

use LemonSqueezy\HttpClient\Message\ResponseMediator;

use LemonSqueezy\HttpClient\Util\JsonObject;

use LemonSqueezy\HttpClient\Util\QueryStringBuilder;

use LemonSqueezy\LemonSqueezy;

use function sprintf;

use stdClass;

abstract class AbstractApi
{
    private const URL_PREFIX = '/v1';
    private LemonSqueezy $client;
    private ?int $perPage;
    private ?int $page;

    public function __construct(LemonSqueezy $client)
    {
        $this->client = $client;
    }

    public function get(string $uri, array $params = [], array $headers = []): stdClass
    {
        if (! is_null($this->perPage) && ! isset($params['per_page'])) {
            $params = array_merge(['per_page' => $this->perPage], $params);
        }

        if (! is_null($this->page) && ! isset($params['page'])) {
            $params = array_merge(['page' => $this->page], $params);
        }

        $response = $this->client->getHttpClient()->get(self::prepareUri($uri, $params), $headers);

        return ResponseMediator::getContent($response);
    }

    public function post(string $uri, array $params = [], array $headers = []): stdClass
    {
        $body = self::prepareJsonBody($params);

        if (! is_null($body)) {
            $headers = self::addJsonContentType($headers);
        }

        $response = $this->client->getHttpClient()->post(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    public function put(string $uri, array $params = [], array $headers = []): stdClass
    {
        $body = self::prepareJsonBody($params);

        if (! is_null($body)) {
            $headers = self::addJsonContentType($headers);
        }

        $response = $this->client->getHttpClient()->put(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    /**
     * @throws Exception
     */
    public function delete(string $uri, array $params = [], array $headers = []): stdClass
    {
        $body = self::prepareJsonBody($params);

        if (! is_null($body)) {
            $headers = self::addJsonContentType($headers);
        }

        $response = $this->client->getHttpClient()->delete(self::prepareUri($uri), $headers, $body ?? '');

        return ResponseMediator::getContent($response);
    }

    private static function prepareUri(string $uri, array $query = []): string
    {
        return sprintf('%s%s%s', self::URL_PREFIX, $uri, QueryStringBuilder::build($query));
    }

    private static function prepareJsonBody(array $params): ?string
    {
        if (0 === count($params)) {
            return null;
        }

        return JsonObject::encode($params);
    }

    private static function addJsonContentType(array $headers): array
    {
        return array_merge([ResponseMediator::CONTENT_TYPE_HEADER => ResponseMediator::JSON_CONTENT_TYPE], $headers);
    }
}
