<?php

use App\Routers\ApiRouter;
use App\Classes\Auth;
use App\Routers\WebRouter;
use Bramus\Router\Router;

$router = new Router();

//our namespace : App\Controllers
$router->setNamespace(CONTROLLER_NAMESPACE);

$api = new ApiRouter($router);
$api->getAllRoutes();

$web = new WebRouter($router);
$web->getAllRoutes();

Auth::routes($router);

$router->run();
