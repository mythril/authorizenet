<?php

file_put_contents('accessed', date('r'), FILE_APPEND);

require_once __DIR__ . '/../vendor/autoload.php';

$cfg = include(__DIR__ . '/../config.php');

use Mythril\AuthorizeNet\NotificationDecoder;

$nh = new NotificationDecoder($cfg['sig_key']);

file_put_contents('notices.csv', json_encode($nh->decodePost()), FILE_APPEND);

