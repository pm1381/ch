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
            $userModel = new UserModel();
            $userEntity = new User();
            if ($userModel->createUser($userEntity, $dataArray)) {
                $token = Tools::createUniqueToken($userModel);
                $userEntity->setToken($token);
                $userModel->updateToken($userEntity);
                $session = new Session();
                $session->set('userId', $token);
                return Tools::setStatus(200, 'registered');
            }
            return Tools::setStatus(400, 'use login page');
        }
        return Tools::setStatus(400, $erros);
        //MUST back to registration form view to see errors
    }
}
