<?php

require_once(__DIR__ . '/_bootstrap.php');

use RingCentral\SDK\Http\ApiException;
use RingCentral\SDK\SDK;

$credentials = require(__DIR__ . '/_credentials.php');

// Create SDK instance

$rcsdk = new SDK($credentials['appKey'], $credentials['appSecret'], $credentials['server'], 'Demo', '1.0.0');

$platform = $rcsdk->platform();

// Authorize

$platform->login($credentials['username'], $credentials['extension'], $credentials['password']);

// Load something nonexistent

try {

    $platform->get('/account/~/whatever');

} catch (ApiException $e) {

    $message = $e->getMessage() . ' (from backend) at URL ' . (string)$e->apiResponse()->request()->getUri();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
