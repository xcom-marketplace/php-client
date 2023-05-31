<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Entity;

use DateTimeImmutable;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
class Product
{
    /**
     * @var string|null
     */
    protected $sku;

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
    protected $type;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string[]|null
     */
    protected $gtins;

    /**
     * @var array|null
     */
    protected $attributes;

    /**
     * @var string|null
     */
    protected $warranty;

    /**
     * @var string|null
     */
    protected $warrantyType;

    /**
     * @var string|null
     */
    protected $manufacturer;

    /**
     * @var string|null
     */
    protected $mpn;

    /**
     * @var string|null
     */
    protected $countryOfAssembly;

    /**
     * @var int|null
     */
    protected $netWeight;

    /**
     * @var int|null
     */
    protected $grossWeight;

    /**
     * @var int|null
     */
    protected $width;

    /**
     * @var int|null
     */
    protected $height;

    /**
     * @var int|null
     */
    protected $depth;

    /**
     * @var int|null
     */
    protected $shippingWidth;

    /**
     * @var int|null
     */
    protected $shippingHeight;

    /**
     * @var int|null
     */
    protected $shippingDepth;

    /**
     * @var DateTimeImmutable|null
     */
    public $creationDate;

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
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

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addGtin(string $gtin): void
    {
        $this->gtins[] = $gtin;
    }

    /**
     * @param string $name
     * @param string|int|float|bool $value
     * @param string|null $unit
     */
    public function addAttribute(string $name, $value, string $unit = null): void
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        if ($value !== null && $value !== '') {
            $this->attributes[] = compact('name', 'value', 'unit');
        }
    }

    public function setWarranty(string $warranty): void
    {
        $this->warranty = $warranty;
    }

    public function setWarrantyType(string $warrantyType): void
    {
        $this->warrantyType = $warrantyType;
    }

    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function setMpn(string $mpn): void
    {
        $this->mpn = $mpn;
    }

    public function setCountryOfAssembly(string $countryOfAssembly): void
    {
        $this->countryOfAssembly = $countryOfAssembly;
    }

    public function setNetWeight(int $netWeight): void
    {
        $this->netWeight = $netWeight;
    }

    public function setGrossWeight(int $grossWeight): void
    {
        $this->grossWeight = $grossWeight;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }

    public function setShippingWidth(int $shippingWidth): void
    {
        $this->shippingWidth = $shippingWidth;
    }

    public function setShippingHeight(int $shippingHeight): void
    {
        $this->shippingHeight = $shippingHeight;
    }

    public function setShippingDepth(int $shippingDepth): void
    {
        $this->shippingDepth = $shippingDepth;
    }

    public function setCreationDate(DateTimeImmutable $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function toArray(): array
    {
        $data = [
            'sku' => $this->sku,
            'brand' => $this->brand,
            'model' => $this->model,
            'name' => $this->name,
            'description' => $this->description,
            'manufacturer' => $this->manufacturer,
            'mpn' => $this->mpn,
            'countryOfAssembly' => $this->countryOfAssembly,
            'netWeight' => $this->netWeight,
            'grossWeight' => $this->grossWeight,
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'shippingWidth' => $this->shippingWidth,
            'shippingHeight' => $this->shippingHeight,
            'shippingDepth' => $this->shippingDepth,
            'warranty' => $this->warranty,
            'warrantyType' => $this->warrantyType,
            'attributes' => $this->attributes,
            'type' => $this->type
        ];

        if ($this->creationDate) {
            $data['creationDate'] = $this->creationDate->format(\DateTimeInterface::ATOM);
        }

        if ($this->gtins) {
            $data['gtins'] = array_values(array_unique($this->gtins));
        }

        return $data;
    }
}
