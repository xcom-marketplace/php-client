<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Response;

use Psr\Http\Message\ResponseInterface;
use XcomMarketplace\Client\Contracts\ResponseInterface as ClientResponseInterface;
use XcomMarketplace\Client\Entity\Entity;
use XcomMarketplace\Client\Exception\UnexpectedResponseException;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
final class UpsertOffersPayload implements ClientResponseInterface
{

    /** @var Entity[] */
    protected $entities;

    public function __construct(ResponseInterface $response)
    {
        $this->handleResponse($response);
    }

    protected function handleResponse(ResponseInterface $response)
    {
        $document = json_decode((string)$response->getBody());

        if (!isset($document, $document->data)) {
            throw UnexpectedResponseException::createFromResponse($response);
        }

        $this->hydrate($document->data);

    }

    protected function hydrate(array $rawEntities)
    {
        foreach ($rawEntities as $rawEntity) {
            $entity = new Entity($rawEntity->id, $rawEntity->type);

            $entity->setLid($rawEntity->lid)
                ->setMeta($rawEntity->meta);

            $this->addEntity($entity);
        }
    }

    protected function addEntity(Entity $entity)
    {
        $this->entities[] = $entity;
    }

    public function getEntities(): array
    {
        return $this->entities;
    }
}
