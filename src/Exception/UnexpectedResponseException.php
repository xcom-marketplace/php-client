<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class UnexpectedResponseException extends ServerException
{
    public static function createFromResponse(ResponseInterface $response): TransportException
    {
        $message = sprintf(
            'HTTP returned unexpected body: "%s". Cropped to 1024 chars, see $e->getResponse()->getBody().',
            mb_substr((string) $response->getBody(), 0, 1024)
        );

        $e = new static($message, $response->getStatusCode());
        $e->setResponse($response);

        return $e;
    }
}
