<?php

declare(strict_types=1);

namespace XcomMarketplace\Client;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class Configuration
{
    /**
     * URL адрес API сервера.
     *
     * @var string
     */
    protected $apiUrl = 'https://partners-products.xcomdb.ru/v1';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var float
     */
    protected $timeout;

    /**
     * Конструктор принимает следующие опции:
     *
     * - apiKey: (string) Идентификатор для аутентификации запросов к API.
     * - timeout: (float) Общее время ожидания запроса в секундах (по умолчанию 5.0). Применяется только при работе
     * со встроенным HTTP клиентом.
     */
    public function __construct(
        string $apiKey,
        float $timeout = 5.0
    )
    {
        $this->setApiKey($apiKey);
        $this->setTimeout($timeout);
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getTimeout(): float
    {
        return $this->timeout;
    }

    public function setApiUrl(string $value): void
    {
        $this->apiUrl = rtrim($value, '/');
    }

    public function setApiKey(string $value): void
    {
        $this->apiKey = $value;
    }

    public function setTimeout(float $value): void
    {
        $this->timeout = $value;
    }
}
