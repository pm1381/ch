<?php
use App\Configs\Application;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Tehran");
define("BASE", __DIR__);
require BASE . '/vendor/autoload.php';

require BASE . '/src/configs/Setup.php';
$application = new Application();
$application->run();