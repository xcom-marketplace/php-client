<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Entity;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
class Offer
{
    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $sku;

    /**
     * @var string|null
     */
    protected $url;

    /**
     * @var string|null
     */
    protected $brand;

    /**
     * @var string|null
     */
    protected $model;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $storeId;

    /**
     * @var int|null
     */
    protected $price;

    /**
     * @var int|null
     */
    protected $priceType;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var int|null
     */
    protected $availableProductCount;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string[]|null
     */
    protected $gtins;

    /**
     * @var string[]|null
     */
    protected $imageUrls;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setStoreId(string $id): void
    {
        $this->storeId = $id;
    }

    public function setPrice(Price $price): void
    {
        $this->price = $price->getAmount();
        $this->priceType = $price->getType();
        $this->currency = $price->getCurrency();
    }

    public function setAvailableProductCount(int $count): void
    {
        $this->availableProductCount = $count;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addGtin(string $gtin): void
    {
        $this->gtins[] = $gtin;
    }

    public function addImageUrl(string $url): void
    {
        $this->imageUrls[] = $url;
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'sku' => $this->sku,
            'url' => $this->url,
            'brand' => $this->brand,
            'model' => $this->model,
            'name' => $this->name,
            'gtins' => array_values(array_unique($this->gtins)),
            'storeId' => $this->storeId,
            'price' => $this->price,
            'priceType' => $this->priceType === PriceType::RETAIL ? 'rozn' : 'opt',
            'currency' => $this->currency,
            'availableProductCount' => $this->availableProductCount,
            'description' => $this->description,
            'images' => array_values(array_unique($this->imageUrls)),
        ];

        return array_filter($data, static function ($value) {
            return $value !== null;
        });
    }
}
