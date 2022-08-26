<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Contracts;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
interface ClientInterface
{
    public function sendRequest(RequestInterface $request): ResponseInterface;
}
