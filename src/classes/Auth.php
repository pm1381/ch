<?php
namespace App\Classes;

use Bramus\Router\Router;

class Auth {

    public static function routes(Router $router, $options=[])
    { 
        self::authMiddleWare($router);
        self::authSite($router, $options);
        self::authAdmin($router, $options);
    }

    public static function authSite(Router $router, array $options) {
        if (! array_key_exists('login', $options)) {
            $router->get('/login', 'site\auth\LoginController@showLoginForm', 'login');
            $router->post('/login', 'site\auth\LoginController@login');
            $router->post('/login', 'site\auth\LoginController@logout', 'logout');
        }

        if (! array_key_exists('password.confirm', $options)) {
            $router->get('/password/confirm', 'site\auth\ConfirmPasswordController@showConfirmationForm', 'password.confirm');
            $router->post('/password/confirm', 'site\auth\ConfirmPasswordController@confirm');
        }

        if (! array_key_exists('password.email', $options)) {
            $router->post('/password/email', 'site\auth\ForgotPasswordController@sendResetLinkEmail', 'password.email');
        }

        if (! array_key_exists('password.reset', $options)) {
            $router->get('/password/reset', 'site\auth\ForgotPasswordController@showLinkRequestForm', 'password.request');
            $router->post('/password/reset', 'site\auth\ResetPasswordController@reset', 'password.update');
            $router->post('/password/reset/{token}', 'site\auth\ResetPasswordController@showResetForm');
        }

        if (! array_key_exists('register', $options)) {
            $router->get('/register', 'site\auth\RegisterConteoller@showRegistrationForm', 'register');
            $router->get('/register', 'site\auth\RegisterConteoller@register');
        }
    }

    public static function authMiddleWare(Router $router)
    {

    }

    public static function authAdmin(Router $router)
    {

    }
}