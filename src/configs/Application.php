<?php

use App\Helpers\Tools;
use App\Databases\Database;

$action = Tools::getUrl();
$mysqldatabase = new Database();
$mysqldatabase->addMysqlConnection();

require_once 'src/routers/web.php';
require_once 'src/routers/api.php';
