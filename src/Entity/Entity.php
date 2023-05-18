<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Entity;

use XcomMarketplace\Client\ValueObject\Meta;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
class Entity
{
    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $lid;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Meta|null
     */
    protected $meta;

    public function __construct(string $type, string $id = null, string $lid = null)
    {
        $this->type = $type;
        $this->id = $id;
        $this->lid = $lid;
    }
    
    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLid(): ?string
    {
        return $this->lid;
    }

    public function getMeta(): ?Meta
    {
        return $this->meta;
    }

    public function setMeta(Meta $meta): void
    {
        $this->meta = $meta;
    }
}
