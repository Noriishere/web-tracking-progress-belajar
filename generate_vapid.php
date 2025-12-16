<?php
require __DIR__ . '/vendor/autoload.php';

use Minishlink\WebPush\VAPID;

$keys = VAPID::createVapidKeys();

echo "VAPID_PUBLIC_KEY_BASE64=" . $keys['publicKey'] . PHP_EOL;
echo "VAPID_PRIVATE_KEY_BASE64=" . $keys['privateKey'] . PHP_EOL;
