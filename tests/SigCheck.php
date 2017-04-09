<?php

require_once __DIR__ . '/../vendor/autoload.php';

$cfg = include(__DIR__ . '/../config.php');

$contents = '{"notificationId":"c71cb68f-0ec9-4f67-8ced-60304a65de79","eventType":"net.authorize.payment.authcapture.created","eventDate":"2017-04-09T00:40:29.1658503Z","webhookId":"3779bf31-1cbb-41f3-964e-c4b8893306f2","payload":{"responseCode":1,"authCode":"O63ENZ","avsResponse":"Y","authAmount":20.00,"entityName":"transaction","id":"60021642780"}}';

$hash = 'sha512=C7136EDE0BDB35DE46F07508A3CF5E9B63E34590D780E44553FDC6C4A7C0B9855B38F1C8FD68376F16A4B627AA03903E9CB495F14DC0DB6C1271EC18CA0B409E';

use Mythril\AuthorizeNet\NotificationDecoder;

$nh = new NotificationDecoder($cfg['sig_key']);

if ($nh->validate($contents, $hash)) {
	echo "results valid\n";
}