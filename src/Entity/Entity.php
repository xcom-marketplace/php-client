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
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $lid;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Meta
     */
    protected $meta;

    public function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLid(): ?string
    {
        return $this->lid;
    }

    public function setLid(string $lid): void
    {
        $this->lid = $lid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMeta(): Meta
    {
        return $this->meta;
    }

    public function setMeta(Meta $meta): void
    {
        $this->meta = $meta;
    }

}
