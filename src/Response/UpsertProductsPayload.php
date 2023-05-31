<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Response;

use XcomMarketplace\Client\Entity\Entity;
use XcomMarketplace\Client\ValueObject\Meta;

/**
 * @author Vlad Alekseev <valekseev@wattdev.ru>
 */
final class UpsertProductsPayload extends UpsertPayload
{

    protected function hydrate(array $resources): bool
    {
        foreach ($resources as $resource) {
            if (!isset($resource['type'], $resource['meta']) && !isset($resource['lid'])) {
                return false;
            }

            $entity = new Entity($resource['type'], null, $resource['lid'] ?? null);
            $entity->setMeta(new Meta($resource['meta']));

            $this->entities[] = $entity;
        }

        return true;
    }
}
