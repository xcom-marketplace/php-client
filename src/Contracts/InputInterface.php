<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Contracts;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
interface InputInterface
{
    public function toArray(): array;
}
