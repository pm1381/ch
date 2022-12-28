<?php

namespace App\Controllers\Site\Auth;

use App\Classes\Date;
use App\Services\User;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Classes\Session;
use App\Interfaces\Auth;
use App\Models\UserModel;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Models\LoginAttemptModel;

class LoginController extends SiteRefrenceController implements Auth {    
    public function showLoginForm()
    {
        // returning related view
    }

    public function login()
    {
        $errors = [];
        if ($this->loginAttempts()) {
            $dataArray = Input::getDataForm();
            $validateResult = $this->AuthValidation($dataArray, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            if ($validateResult['error'] == false) {
                $user = new User();
                $user->setEmail($dataArray['email']);
                $user->setPassword($dataArray['password']);
                $this->model = new UserModel();
                $result = $this->model->loginCheck($user);
                
                if (count($result) > 0) {
                    $user->setId($result[0]->id);
                    if (array_key_exists('rememberMe', $dataArray) && $dataArray['rememberMe']) {
                        $token = Tools::createUniqueToken($this->model);
                        $user->setToken($token);
                        $this->model->updateToken($user);
                        $session = new Session();
                        $session->set('userId', $token);
                    }
                    return Tools::setStatus(200, 'logged in');
                }

                $this->addLoginAttempt();
                return Tools::setStatus(400, 'user does not exist');
            }
            $errors = $validateResult['grabResult'];
            return Tools::setStatus(400, $errors);
        }
        return Tools::setStatus(400, 'too many attempts');        
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
        $attempModel = new LoginAttemptModel();
        $count = $attempModel->howManyAttempts(Tools::getIp());
        if  ($count > 3)
            return false;
        return true;
    }

    private function addLoginAttempt()
    {
        $attempModel = new LoginAttemptModel();
        $attempModel->addAttempt();
    }

}