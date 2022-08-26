<?php

declare(strict_types=1);

namespace XcomMarketplace\Client;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
trait HttpClientAwareTrait
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function setHttpClient(ClientInterface $client): void
    {
        $this->httpClient = $client;
    }

    protected function getHttpClient(Configuration $configuration): ClientInterface
    {
        if ($this->httpClient === null) {
            $this->httpClient = new Client([
                'http_errors' => false,
                'timeout' => $configuration->getTimeout()
            ]);
        }

        return $this->httpClient;
    }
}
