<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class TransportException extends Exception
{
    /**
     * @var RequestInterface|null
     */
    protected $request;

    /**
     * @var ResponseInterface|null
     */
    protected $response;

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function setRequest(?RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(?ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public static function createFromResponse(ResponseInterface $response): TransportException
    {
        $message = sprintf('HTTP %d returned.', $response->getStatusCode());

        $e = new static($message, $response->getStatusCode());
        $e->setResponse($response);

        return $e;
    }
}
