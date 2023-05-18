<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\ValueObject;

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

    /**
     * @var \DateTimeInterface
     */
    protected $validUntil;

    public function __construct(
        int $amount,
        string $currency,
        int $type = PriceType::RETAIL,
        \DateTimeInterface $validUntil = null
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->type = $type;
        $this->validUntil = $validUntil;
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

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->validUntil;
    }
}
