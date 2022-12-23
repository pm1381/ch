<?php

namespace App\Controllers\Site;

use App\Services\User;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Events\PasswordChange;
use App\Helpers\Input;
use App\Helpers\Tools;

use function PHPSTORM_META\type;

class UserController extends SiteRefrenceController {


    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers() {
        $forgotPassEvent = new PasswordChange(new User, ['email' => 'parham.minou@gmail.com']);
        $forgotPassEvent->dispatch();
        die();
        // we can also change the format of log file
        self::$controllerLog->info('getting all users');
        $users = json_decode($this->model->getAll(), true);
        if (count($users)) {
            Tools::setStatus(200, 'founded users', $users);
        }
    }

    public function createUser() {
        $insertData = Input::getDataJson(true);
        $user = $this->makeClassData($insertData, User::class);
        if (is_object($user)) {
            self::$controllerLog->info('creating a user', ['userPhone' => $user->getUserName()]);
            $checkUser = $this->model->insertUser($user);
            if ($checkUser) {
                Tools::setStatus(200, 'user created', ['status' => $checkUser]);
            } else {
                Tools::setStatus(400, 'sth wrong while inserting', ['status' => $checkUser]);
            }
        } else {
            Tools::setStatus(400, 'incomplete data input', []);
        }
    }

    public function getUserById($id) {
        $users = $this->model->getById($id);
        if (count($users)) {
            self::$controllerLog->info('get a user', ['userId' => $id]);
            Tools::setStatus(200, 'founded users', $users);
        } else {
            Tools::setStatus(200, 'no user found', []);
        }
    }

    public function updateUser($id) {
        $updateData = Input::getDataJson(true);
        $check = $this->model->updateById($updateData, $id);
        if ($check) {
            self::$controllerLog->info('updating a user', ['userId' => $id]);
            Tools::setStatus(200, 'user updated', ['status' => $check]);
        } else {
            Tools::setStatus(400, 'sth wrong while inserting', ['status' => $check]);
        }
    }
}