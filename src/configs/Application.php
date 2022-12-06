<?php

use App\Classes\Gate;
use App\Classes\User;
use App\Helpers\Input;
use App\Database\Database;
use App\Exceptions\Handler;
use App\Models\UserModel;
use App\Policies\HandleAuthorization;
use App\Routers\RouteProvider;
use Bramus\Router\Router;

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

$handleAuth = new HandleAuthorization();
$handleAuth->registerPolicies();

$route = new RouteProvider(new Router());
$route->routeManage();

?>
