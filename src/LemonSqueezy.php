<?php

declare(strict_types=1);

namespace LemonSqueezy;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use LemonSqueezy\HttpClient\Builder;
use LemonSqueezy\HttpClient\Plugin\Authentication;
use LemonSqueezy\HttpClient\Plugin\ExceptionThrower;
use LemonSqueezy\HttpClient\Plugin\History;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class LemonSqueezy
{
    private const BASE_URL = 'https://api.lemonsqueezy.com';
    private const API_VERSION = '/v1';
    private const API_ACCEPT = 'application/vnd.api+json';
    private const API_CONTENT_TYPE = 'application/vnd.api+json';
    private $httpClientBuilder;
    private $responseHistory;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();
        $this->responseHistory = new History();

        $builder->addPlugin(new ExceptionThrower());
        $builder->addPlugin(new HistoryPlugin($this->responseHistory));
        $builder->addPlugin(new RedirectPlugin());

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'Accept' => self::API_ACCEPT,
            'Content-Type' => self::API_CONTENT_TYPE,
        ]));

        $this->setUrl(self::BASE_URL);
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);
        return new self($builder);
    }

    public function authenticate(string $apiKey): void
    {
        $this->getHttpClientBuilder()->addPlugin(new Authentication($apiKey));
    }

    public function setUrl(string $url): void
    {
        $this->httpClientBuilder->removePlugin(AddHostPlugin::class);
        $this->httpClientBuilder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($url)));
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->responseHistory->getLastResponse();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    public function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
