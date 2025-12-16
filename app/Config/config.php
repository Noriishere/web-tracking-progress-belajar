<?php

define('BASE_URL', 'http://localhost/composer-template/public/');
define('YOUTUBE_API_KEY', $_ENV['API_KEY'] ?? '');
define('SMTP_USER',$_ENV['SMTP_USER'] ?? '');
define('SMTP_PASS',$_ENV['SMTP_PASS'] ?? '');
define('SMTP_HOST',$_ENV['SMTP_HOST'] ?? '');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_fp');
define('VAPID_PUBLIC_KEY', $_ENV['VAPID_PUBLIC_KEY_BASE64'] ?? '');
define('VAPID_PRIVATE_KEY', $_ENV['VAPID_PRIVATE_KEY_BASE64'] ?? '');
define('VAPID_SUBJECT', 'mailto:miawaugch@gmail.com');