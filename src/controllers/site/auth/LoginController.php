<?php

namespace App\Controllers\Site\Auth;

use App\Services\User;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Classes\Session;
use App\Interfaces\Auth;
use App\Models\UserModel;
use App\Controllers\Refrence\SiteRefrenceController;

class LoginController extends SiteRefrenceController implements Auth {    
    public function checkLogin($data)
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $this->model = new UserModel();
        if (array_key_exists('rememberMe', $data) && $data['rememberMe']) {
            $token = Tools::createUniqueToken($this->model);
            $user->setToken($token);
            $session = new Session();
            $session->set('userId', $token);
        }

        return $this->model->loginCheck($user);
    }

    public function showLoginForm()
    {
        // returning related view
    }

    public function login()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validateResult['error'] == false) {
            if (count($this->checkLogin($dataArray))) {
                // Tools::redirect($this->redirectTo, 301);
            } else {
                Tools::setStatus(400, 'email and password does not exist');
            }
        }
        $errors = $validateResult['grabResult'];
        Tools::setStatus(400, 'error in entering data');
        //MUST back to registration form view to see errors
    }

    public function logout()
    {
        $session = new Session();
        $session->delete('userId');
        Tools::redirect($this->redirectTo, 301);
    }

    private function loginAttempts()
    {
        // check wrong number of neseccary attempts;
    }

}