<?php

declare(strict_types=1);

use XcomMarketplace\Client\Client;
use XcomMarketplace\Client\Configuration;
use XcomMarketplace\Client\Entity\Product;
use XcomMarketplace\Client\Exception\ClientException;
use XcomMarketplace\Client\Exception\ServerException;
use XcomMarketplace\Client\Exception\TransportException;
use XcomMarketplace\Client\Exception\UnprocessableEntityException;
use XcomMarketplace\Client\Input\UpsertProductsInput;
use XcomMarketplace\Client\Request\UpsertProductsRequest;
use XcomMarketplace\Client\Response\UpsertPayload;
use XcomMarketplace\Client\ValueObject\ProductType;


$config = new Configuration('00000000-0000-0000-0000-000000000000');
$client = new Client($config);

$input = new UpsertProductsInput();

$product = new Product();
$product->setSku('CM8071504555318-SRL4W');
$product->setBrand('Intel');
$product->setName('Core i5-12400F OEM');
$product->setType(ProductType::PHYSICAL);

$input->addProduct($product);

$request = new UpsertProductsRequest($input);

try {
    /**
     * @var UpsertPayload $payload
     */
    $payload = $client->sendRequest($request);


    foreach ($payload->getEntities() as $entity) {
        $meta = $entity->getMeta();

        if ($meta->get('status') === 422) {
            // Unprocessable Products.
            // Status code = 422.
            if ($errors = $meta->get('errors')) {
                // Errors list for Product.
            }
        }
    }

} catch (UnprocessableEntityException $e) {
    // Unprocessable Product(s).
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

