<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Mythril\AuthorizeNet\API;
use Mythril\AuthorizeNet\GetTransactionDetails;

$cfg = include(__DIR__ . '/../config.php');

$api = new API(
	$cfg['name'],
	$cfg['tk'],
	$cfg['sandbox']
);

$result = $api->execute(new GetTransactionDetails('60021729866'));

echo json_encode($result, JSON_PRETTY_PRINT), "\n";
