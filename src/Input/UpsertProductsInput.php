<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Input;

use XcomMarketplace\Client\Contracts\InputInterface;
use XcomMarketplace\Client\Entity\Product;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
class UpsertProductsInput implements InputInterface
{
    /** @var Product[] */
    protected $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[] = $product->toArray();
    }

    public function toArray(): array
    {
        $document = ['data' => []];

        foreach ($this->products as $i => $product) {
            $document['data'][] = [
                'type' => 'products',
                'lid' => (string) $i,
                'attributes' => $product
            ];
        }
        
        return $document;
    }
}
