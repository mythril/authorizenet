<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Mythril\AuthorizeNet\API;
use Mythril\AuthorizeNet\Authenticate;

$cfg = include(__DIR__ . '/../config.php');

$api = new API(
	$cfg['name'],
	$cfg['tk'],
	$cfg['sandbox']
);

$result = $api->execute(new Authenticate());

var_dump($result);
