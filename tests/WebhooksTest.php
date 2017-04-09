<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Mythril\AuthorizeNet as A;

$cfg = include(__DIR__ . '/../config.php');

$wh = new A\Webhook(
	$cfg['name'],
	$cfg['tk'],
	$cfg['sandbox']
);

$result = $wh->get('eventtypes');
$eventTypes = array();

foreach (json_decode($result, true) as $eventType) {
	$eventTypes[] = $eventType['name'];
	echo $eventType['name'], "\n";
}

$result2 = $wh->post('webhooks', array(
	'url' => $cfg['webhook_url'],
	'eventTypes' => $eventTypes,
	'status' => 'active'
));

echo $result2;
