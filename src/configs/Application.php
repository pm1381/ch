<?php

use App\Database\Database;
use App\Exceptions\Handler;
use App\Helpers\Input;

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

$mysqldatabase = new Database;
$mysqldatabase->addMysqlConnection();

require_once 'src/routers/index.php';

?>
