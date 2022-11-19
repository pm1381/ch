<?php

use App\Classes\Date;
use App\Database\Database;
use App\Exceptions\Handler;
use App\Helpers\Input;
use App\Helpers\Tools;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// other whoops handlers:
// $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
// $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function($error) {
    $handler = new Handler();
    $handler->report($error);
    $handler->render(Input::getDataForm(), $error);
}));
$whoops->register();


$action = Tools::getUrl();
$mysqldatabase = new Database;
$mysqldatabase->addMysqlConnection();

require_once 'src/routers/web.php';
require_once 'src/routers/api.php';

?>
