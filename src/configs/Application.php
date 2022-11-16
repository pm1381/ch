<?php

use App\Helpers\Tools;
use App\Databases\Database;

$action = Tools::getUrl();
$database = new Database();
$database->addConnection();

require_once 'src/routers/web.php';
require_once 'src/routers/api.php';
