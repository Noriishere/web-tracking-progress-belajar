<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '1');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require_once __DIR__ . '/../app/config/config.php';

$app = new \FpSmt3\WebTracker\Core\App();