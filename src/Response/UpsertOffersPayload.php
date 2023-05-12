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
    private $entities;

    public function __construct(ResponseInterface $response)
    {
        $this->handleResponse($response);
    }

    public function getEntities(): array
    {
        return $this->entities;
    }

    private function handleResponse(ResponseInterface $response)
    {
        $document = json_decode((string)$response->getBody(), true);

        if (!isset($document['data'])) {
            throw UnexpectedResponseException::createFromResponse($response);
        }

        $this->hydrate($document['data']);

    }

    private function hydrate(array $rawEntities)
    {
        foreach ($rawEntities as $rawEntity) {
            $entity = new Entity($rawEntity['id'], $rawEntity['type']);

            $entity->setLid($rawEntity['lid']);

            $entity->setMeta(new Meta($rawEntity['meta']));

            $this->entities[] = $entity;
        }
    }

}
