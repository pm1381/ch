<?php

use App\Classes\Auth;
use Bramus\Router\Router;

$router = new Router();

//our namespace : App\Controllers
$router->setNamespace(CONTROLLER_NAMESPACE);

//middlewares
$router->before('GET', '/users.*', 'middlewares\site\UserMiddleWare@numCheck');
//point : id in here has dependency injection

$router->get('/users/', 'site\UserController@getUsers');
$router->get("/users/{id}/", 'site\UserController@getUserById');
$router->post("/users/", 'site\UserController@createUser');
$router->post("/users/{id}/", 'site\UserController@updateUser');

Auth::routes($router);

// print_f($router, true);

$router->run();