<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Request;

use XcomMarketplace\Client\Response\UpsertProductsPayload;

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
        return UpsertProductsPayload::class;
    }
}
