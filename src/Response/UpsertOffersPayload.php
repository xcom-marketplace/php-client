<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Response;

use Psr\Http\Message\ResponseInterface;
use XcomMarketplace\Client\Contracts\ResponseInterface as ClientResponseInterface;
use XcomMarketplace\Client\Entity\Entity;
use XcomMarketplace\Client\Exception\UnexpectedResponseException;
use XcomMarketplace\Client\ValueObject\Meta;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
final class UpsertOffersPayload implements ClientResponseInterface
{
    /** @var Entity[] */
    private $entities = [];

    public function __construct(ResponseInterface $response)
    {
        $this->handleResponse($response);
    }

    public function getEntities(): array
    {
        return $this->entities;
    }

    private function handleResponse(ResponseInterface $response): void
    {
        $document = json_decode((string) $response->getBody(), true);

        if (!isset($document['data']) || !is_array($document['data']) || !$this->hydrate($document['data'])) {
            throw UnexpectedResponseException::createFromResponse($response);
        }
    }

    private function hydrate(array $resources): bool
    {
        foreach ($resources as $resource) {
            if (!isset($resource['type'], $resource['meta']) || !isset($resource['id']) && !isset($resource['lid'])) {
                return false;
            }
            
            $entity = new Entity($resource['type'], $resource['id'] ?? null, $resource['lid'] ?? null);
            $entity->setMeta(new Meta($resource['meta']));

            $this->entities[] = $entity;
        }
        
        return true;
    }
}
