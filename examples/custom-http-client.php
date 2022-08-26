<?php

declare(strict_types=1);

use XcomMarketplace\Client\Client;
use XcomMarketplace\Client\Configuration;

// Compatible with PSR-18, such as Guzzle.
// We should control the total timeout of the request yourself.
$httpClient = new GuzzleHttp\Client([
    'proxy' => 'http://localhost:8125',
    'timeout' => 2
]);

$config = new Configuration(
    '00000000-0000-0000-0000-000000000000',
    7 // No effect
);

$client = new Client($config);
$client->setHttpClient($httpClient);
