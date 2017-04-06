<?php

require_once __DIR__ . '/../vendor/autoload.php';

$cfg = include(__DIR__ . '/../config.php');

$api = new Mythril\AuthorizeNet\API(
	$cfg['name'],
	$cfg['tk'],
	$cfg['sandbox']
);

$result = $api->execute(new Mythril\AuthorizeNet\Authenticate());

var_dump($result);
