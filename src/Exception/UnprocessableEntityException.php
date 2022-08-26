<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Exception;

use Psr\Http\Message\ResponseInterface;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class UnprocessableEntityException extends ClientException
{
    public static function createFromResponse(ResponseInterface $response): TransportException
    {
        $e = new static('Unprocessable entities, see $e->getErrors().', $response->getStatusCode());
        $e->setResponse($response);

        return $e;
    }

    public function getErrors(): array
    {
        if ($this->response && $errors = json_decode((string) $this->response->getBody(), true)) {
            return (array) $errors;
        }

        return [];
    }
}
