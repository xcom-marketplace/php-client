<?php

declare(strict_types=1);

use XcomMarketplace\Client\Client;
use XcomMarketplace\Client\Configuration;
use XcomMarketplace\Client\Entity\Offer;
use XcomMarketplace\Client\Exception\ClientException;
use XcomMarketplace\Client\Exception\Exception;
use XcomMarketplace\Client\Exception\ServerException;
use XcomMarketplace\Client\Exception\TransportException;
use XcomMarketplace\Client\Exception\UnprocessableEntityException;
use XcomMarketplace\Client\Input\UpsertOffersInput;
use XcomMarketplace\Client\Request\UpsertOffersRequest;
use XcomMarketplace\Client\Response\UpsertOffersPayload;
use XcomMarketplace\Client\ValueObject\Price;
use XcomMarketplace\Client\ValueObject\PriceType;

$config = new Configuration('00000000-0000-0000-0000-000000000000');
$client = new Client($config);

$input = new UpsertOffersInput();

$offer = new Offer();
$price = new Price(2300000, 'RUB', PriceType::RETAIL);

$offer->setId('286594');
$offer->setUrl('https://seller.ru/product/286594');
$offer->setPrice($price);
$offer->setSku('CM8071504555318-SRL4W');

$input->addOffer($offer);

$offer = new Offer();
$price = new Price(2000000, 'RUB', PriceType::WHOLESALE);

$offer->setId('286595');
$offer->setUrl('https://seller.ru/product/286595');
$offer->setPrice($price);
$offer->setSku('CM8071504555318-SRL4W');

$input->addOffer($offer);

$request = new UpsertOffersRequest($input);

try {
    /**
     * @var UpsertOffersPayload $payload
     */
    $payload = $client->sendRequest($request);

    $entities = $payload->getEntities();

    foreach ($entities as $entity) {
        $meta = $entity->getMeta();
        if (isset($meta->status) && $meta->status === 422) {
            // Unprocessable Offer.
            // Status code = 422.
        }
    }
} catch (UnprocessableEntityException $e) {
    // Unprocessable Offer(s).
    // Response code = 422.
    $errors = $e->getErrors();
} catch (ClientException $e) {
    // Other client errors, such as network errors or mandatory authentication.
    // Response code = 0 or 400 <= response code < 500.
} catch (ServerException $e) {
    // Server errors.
    // Response code >= 500.
} catch (TransportException $e) {
    // The above exceptions extend TransportException and have the following methods.
    $psr7Request = $e->getRequest();
    $psr7Response = $e->getResponse();
} catch (Exception $e) {
    // Exception is ancestor the above exceptions. Useful for catching all library exceptions.
}
