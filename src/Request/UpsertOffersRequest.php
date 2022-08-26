<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Request;

use XcomMarketplace\Client\Response\UpsertOffersPayload;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
final class UpsertOffersRequest extends AbstractMutationRequest
{
    public function getPath(): string
    {
        return '/offers';
    }

    public function getResponseClassName(): string
    {
        return UpsertOffersPayload::class;
    }
}
