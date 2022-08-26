<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Entity;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class Price
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $type;

    public function __construct(int $amount, string $currency, int $type = PriceType::RETAIL)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->type = $type;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
