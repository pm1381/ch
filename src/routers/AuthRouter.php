<?php

namespace App\Routers;

class AuthRouter {

    private $router;
    private $options = [];

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function getAllRoutes()
    {
        $this->authMiddleWare();
        $this->authSite();
        $this->authAdmin();
    }

    private function authSite()
    {
        if (! array_key_exists('login', $this->options)) {
            $this->router->get('/login/', 'site\auth\LoginController@showLoginForm', 'login');
            $this->router->post('/login/', 'site\auth\LoginController@login');
            $this->router->post('/logout/', 'site\auth\LoginController@logout', 'logout');
        }

        if (! array_key_exists('password.confirm', $this->options)) {
            $this->router->get('/password/confirm/', 'site\auth\ConfirmPasswordController@showConfirmationForm', 'password.confirm');
            $this->router->post('/password/confirm/', 'site\auth\ConfirmPasswordController@confirm');
        }

        if (! array_key_exists('password.email', $this->options)) {
            $this->router->post('/password/email/', 'site\auth\ForgotPasswordController@sendResetLinkEmail', 'password.email');
        }

        if (! array_key_exists('password.reset', $this->options)) {
            $this->router->get('/password/reset/', 'site\auth\ForgotPasswordController@showLinkRequestForm', 'password.request');
            $this->router->post('/password/reset/', 'site\auth\ResetPasswordController@reset', 'password.update');
            $this->router->get('/password/reset/{token}/', 'site\auth\ResetPasswordController@showResetForm');
        }

        if (! array_key_exists('register', $this->options)) {
            $this->router->get('/register/', 'site\auth\RegisterController@showRegistrationForm', 'register');
            $this->router->post('/register/', 'site\auth\RegisterController@register');
        }
        // print_f($this->router);
    }

    private function authMiddleWare(){
        $this->router->before('post', '/login/', 'middlewares\site\LoginMiddleWare@ipCheck');
    }
    private function authAdmin(){}
}

