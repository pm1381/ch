<?php

namespace App\Controllers\Site\Auth;

use App\Helpers\Input;
use App\Helpers\Tools;
use App\Entities\User;
use App\Classes\Session;
use App\Interfaces\Auth;
use App\Classes\Response;
use App\Models\UserModel;
use App\Controllers\Refrence\SiteRefrenceController;

class RegisterController extends SiteRefrenceController implements Auth {
    public function showRegistrationForm()
    {
        Tools::render(VIEW . "site/auth/showRegister.php");
    }

    public function register()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validateResult['error'] == false) {
            $userModel = new UserModel();
            $userEntity = new User();
            if ($userModel->createUser($userEntity, $dataArray)) {
                $token = Tools::createUniqueToken($userModel);
                $userEntity->setToken($token);
                $userModel->updateToken($userEntity);
                $session = new Session();
                $session->set('userId', $token);
                return Response::setStatus(200, 'registered');
            }
            return Response::setStatus(400, 'use login page');
        }
        $session = new Session();
        $session->setFlash('error', $validateResult['grabResult']);
        return Response::setStatus(400, $validateResult['grabResult']);
        //MUST back to registration form view to see errors
    }
}
