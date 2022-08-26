<?php

declare(strict_types=1);

namespace XcomMarketplace\Client\Response;

use Psr\Http\Message\ResponseInterface;
use XcomMarketplace\Client\Contracts\ResponseInterface as ClientResponseInterface;
use XcomMarketplace\Client\Exception\UnexpectedResponseException;

/**
 * @author Vladimir Solovyov <vsolovyov@wattdev.ru>
 */
final class UpsertOffersPayload implements ClientResponseInterface
{
    /**
     * @var int
     */
    private $updatedContentCount;

    /**
     * @var int
     */
    private $updatedPriceCount;

    public function __construct(ResponseInterface $response)
    {
        $data = json_decode((string) $response->getBody());

        if (
            !isset($data->updatedContentCount, $data->updatedPriceCount)
            || !is_int($data->updatedContentCount)
            || !is_int($data->updatedPriceCount)
        ) {
            throw UnexpectedResponseException::createFromResponse($response);
        }

        $this->updatedContentCount = $data->updatedContentCount;
        $this->updatedPriceCount = $data->updatedPriceCount;
    }

    public function getUpdatedContentCount(): int
    {
        return $this->updatedContentCount;
    }

    public function getUpdatedPriceCount(): int
    {
        return $this->updatedPriceCount;
    }
}
