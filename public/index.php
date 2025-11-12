<?php
session_start();
require_once '../app/Config/config.php';

require_once '../vendor/autoload.php';

use FpSmt3\WebTracker\Core\App;

$app = new App();