<?php

namespace App\Controllers\Site\Auth;

use App\Classes\Session;
use App\Services\User;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Interfaces\Auth;
use App\Models\UserModel;

class RegisterController extends SiteRefrenceController implements Auth {
    public function create($data)
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $this->model = new UserModel();
        $token = Tools::createUniqueToken($this->model);
        $user->setToken($token);
        if ($this->model->insertUser($user)) {
            $session = new Session();
            $session->set('userId', $token);
            return true;
        }
        return false;
    }

    public function showRegistrationForm()
    {
        // this one must return a page (only)
    }

    public function register()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $erros = $validateResult['grabResult'];
        if ($validateResult['error'] == false) {
            if ($this->create($dataArray)) {
                Tools::setStatus(200, 'registered');
                Tools::redirect($this->redirectTo, 301);
            } else
                $erros[] = 'use login page';
        }
        if (count($erros)) {
            Tools::setStatus(400, $erros);
        }
        //MUST back to registration form view to see errors
    }
}
