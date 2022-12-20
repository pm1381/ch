<?php

namespace App\Controllers\Site\Auth;

use App\Services\User;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Interfaces\Auth;
use App\Models\UserModel;
use Ghostff\Session\Session;

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
        $this->model->insertUser($user);

        $session = new Session();
        $session->set('userId', $token);
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
            'password' => 'required|min:6',
            'confirmPass' => 'required|same:password'
        ]);
        if ($validateResult['error'] == false) {
            $this->create($dataArray);
            Tools::redirect($this->redirectTo, 301);
        }
        $erros = $validateResult['grabResult'];
        Tools::setStatus(400, 'error in entering data');
        //MUST back to registration form view to see errors
    }


}