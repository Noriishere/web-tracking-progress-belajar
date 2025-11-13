<?php
session_start();
require_once __DIR__ . '/../app/config/config.php';

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \FpSmt3\WebTracker\Core\App();