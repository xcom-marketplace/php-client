<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Input;

use XcomMarketplace\Client\Contracts\InputInterface;
use XcomMarketplace\Client\Entity\Offer;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class UpsertOffersInput implements InputInterface
{
    /** @var Offer[] */
    protected $offers = [];

    public function addOffer(Offer $offer): void
    {
        $this->offers[] = $offer->toArray();
    }

    public function toArray(): array
    {
        return ['offers' => $this->offers];
    }
}
