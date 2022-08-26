<?php

declare(strict_types=1);

namespace XcomMarketplace\Client;

use GuzzleHttp\Psr7\Request as Psr7Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface as Psr7RequestInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use XcomMarketplace\Client\Contracts\ClientInterface;
use XcomMarketplace\Client\Contracts\RequestInterface;
use XcomMarketplace\Client\Contracts\ResponseInterface;
use XcomMarketplace\Client\Exception\ClientException;
use XcomMarketplace\Client\Exception\ServerException;
use XcomMarketplace\Client\Exception\TransportException;
use XcomMarketplace\Client\Exception\UnprocessableEntityException;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class Client implements ClientInterface
{
    use HttpClientAwareTrait;
    use LoggerAwareTrait;

    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->logger = new NullLogger();
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $psr7Request = $this->createPsr7Request($request);

        $this->logger->debug(sprintf(
            'HTTP request: "%s" "%s" "%s".',
            $psr7Request->getMethod(),
            $psr7Request->getUri(),
            $psr7Request->getBody()
        ));

        try {
            $psr7Response = $this->getHttpClient($this->configuration)
                ->sendRequest($psr7Request);
        } catch (NetworkExceptionInterface $e) {
            $exception = new ClientException($e->getMessage(), 0, $e);
            $exception->setRequest($psr7Request);

            throw $exception;
        } catch (ClientExceptionInterface $e) {
            if (
                method_exists($e, 'getResponse')
                && $e->getResponse() instanceof Psr7ResponseInterface
            ) {
                $psr7Response = $e->getResponse();
            }
        }

        if (!isset($psr7Response)) {
            $exception = new ClientException('HTTP request failed.', 0, $e ?? null);
            $exception->setRequest($psr7Request);

            throw $exception;
        }

        $this->logger->debug(sprintf(
            'HTTP response: %d "%s".',
            $psr7Response->getStatusCode(),
            $psr7Response->getBody()
        ));

        try {
            $this->throwExceptionIfRequestUnsuccessful($psr7Response);

            return new ($request->getResponseClassName())($psr7Response);
        } catch (TransportException $e) {
            $e->setRequest($psr7Request);

            throw $e;
        }
    }

    protected function createPsr7Request(RequestInterface $request): Psr7RequestInterface
    {
        $headers = array_merge(
            ['Api-Key' => $this->configuration->getApiKey()],
            $request->getHeaders()
        );

        return new Psr7Request(
            $request->getMethod(),
            $this->configuration->getApiUrl() . $request->getPath(),
            $headers,
            $request->getBody()
        );
    }

    protected function throwExceptionIfRequestUnsuccessful(Psr7ResponseInterface $response): void
    {
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return;
        }

        if ($response->getStatusCode() === 422) {
            throw UnprocessableEntityException::createFromResponse($response);
        }

        if ($response->getStatusCode() >= 300 && $response->getStatusCode() < 500) {
            throw ClientException::createFromResponse($response);
        }

        if ($response->getStatusCode() >= 500) {
            throw ServerException::createFromResponse($response);
        }
    }
}
