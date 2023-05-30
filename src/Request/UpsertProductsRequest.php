<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Request;

use XcomMarketplace\Client\Response\UpsertPayload;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
final class UpsertProductsRequest extends AbstractMutationRequest
{
    public function getPath(): string
    {
        return '/products';
    }

    public function getResponseClassName(): string
    {
        return UpsertPayload::class;
    }
}
