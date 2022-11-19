<?php

namespace App\Controllers\Site\Auth;

use App\Classes\User;
use App\Classes\Validation;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Arrays;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Interfaces\Auth;
use App\Models\UserModel;
use Ghostff\Session\Session;
use Rakit\Validation\Validator;

class RegisterController extends SiteRefrenceController implements Auth {

    protected $redirectTo = BASE_URI;

    public function AuthCreate($data)
    {

        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        $this->model = new UserModel();
        $this->model->insertUser($user);

        $session = new Session();
        $session->set('userId', $user->getPassword());
    }

    public function AuthValidation($data)
    {   
        $validation = new Validation($data, new Validator(Arrays::errorView()));
        $validation->makeValidation([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmPass' => 'required|same:password'
        ]);
        return $validation->handleValidationError();
    }

    public function showRegistrationForm()
    {
        // this one must return a page (only)
    }

    public function register()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray);
        if ($validateResult['error'] == false) {
            $this->AuthCreate($dataArray);
            $user = new User();
            if ($user->isLogin()) {
                Tools::redirect($this->redirectTo, 301);
            }
        }
        $erros = $validateResult['grabResult'];
        //remember at the end of the request U MUST back to registration form view to see errors
    }


}