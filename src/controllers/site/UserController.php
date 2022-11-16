<?php

namespace App\Controllers\Site;

use App\Classes\User;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Input;
use App\Helpers\Tools;

class UserController extends SiteRefrenceController {


    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers() {
        // we can also change the format of log file
        self::$controllerLog->info('getting all users');
        $users = $this->model->getAll();
        if (count($users)) {
            Tools::setStatus(200, 'founded users', $users);
        }
    }

    public function createUser() {
        $insertData = Input::getDataFromJson(true);
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
        $updateData = Input::getDataFromJson(true);
        $check = $this->model->updateById($updateData, $id);
        if ($check) {
            self::$controllerLog->info('updating a user', ['userId' => $id]);
            Tools::setStatus(200, 'user updated', ['status' => $check]);
        } else {
            Tools::setStatus(400, 'sth wrong while inserting', ['status' => $check]);
        }
    }
}