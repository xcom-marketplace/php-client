<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Entity;

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
     * @var string|null
     */
    protected $lid;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \stdClass
     */
    protected $meta;

    public function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLid(): ?string
    {
        return $this->lid;
    }

    /**
     * @param string|null $lid
     * @return Entity
     */
    public function setLid(?string $lid): Entity
    {
        $this->lid = $lid;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return \stdClass
     */
    public function getMeta(): \stdClass
    {
        return $this->meta;
    }

    /**
     * @param \stdClass $meta
     * @return Entity
     */
    public function setMeta(\stdClass $meta): Entity
    {
        $this->meta = $meta;
        return $this;
    }

}
