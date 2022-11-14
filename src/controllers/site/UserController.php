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
        $users = $this->model->getAll();
        if (count($users)) {
            Tools::setStatus(200, 'founded users', $users);
        }
    }

    public function createUser() {
        $insertData = Input::getDataFromJson(true);
        $user = $this->makeClassData($insertData, User::class);
        if (is_object($user)) {
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
            Tools::setStatus(200, 'founded users', $users);
        } else {
            Tools::setStatus(200, 'no user found', []);
        }
    }

    public function updateUser($id) {
        $updateData = Input::getDataFromJson(true);
        $check = $this->model->updateById($updateData, $id);
        if ($check) {
            Tools::setStatus(200, 'user updated', ['status' => $check]);
        } else {
            Tools::setStatus(400, 'sth wrong while inserting', ['status' => $check]);
        }
    }
}