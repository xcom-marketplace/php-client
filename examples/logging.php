<?php

declare(strict_types=1);

use Psr\Log\NullLogger;
use XcomMarketplace\Client\Client;
use XcomMarketplace\Client\Configuration;

// Compatible with PSR-3, such as Monolog.
$logger = new NullLogger();

$config = new Configuration('00000000-0000-0000-0000-000000000000');

$client = new Client($config);
$client->setLogger($logger);
