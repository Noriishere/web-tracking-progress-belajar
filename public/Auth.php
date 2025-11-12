<?php
require_once __DIR__ . '/../vendor/autoload.php';

use FpSmt3\WebTracker\Controllers\User\Auth;

define('BASE_URL', 'http://localhost/web-tracker/public/');

$auth = new Auth();
$auth->handleRequest();