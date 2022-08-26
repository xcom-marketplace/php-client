<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Contracts;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
interface RequestInterface
{
    public function getMethod(): string;

    public function getPath(): string;

    public function getHeaders(): array;

    public function getBody(): ?string;

    public function getResponseClassName(): string;
}
