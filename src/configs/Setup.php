<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Tehran");

use App\Databases\Database;
use App\Helpers\Tools;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

require_once 'src/configs/Static.php';
require_once 'src/configs/Config.php';

$action = Tools::getUrl();
$database = new Database();
$database->addConnection();

require_once 'src/helpers/Router.php';