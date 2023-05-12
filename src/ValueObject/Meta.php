<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\ValueObject;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
class Meta
{
    /**
     * @var array
     */
    protected $storage;

    public function __construct(array $metaData)
    {
        $this->storage = $metaData;
    }

    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->storage[$key] : $default;
    }

    public function all(): array
    {
        return $this->storage;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->storage);
    }

    public function count(): int
    {
        return \count($this->storage);
    }
}
