<?php

namespace App\Controllers\Site;

use App\Helpers\Input;
use App\Entities\User;
use App\Classes\Response;
use App\Controllers\Refrence\SiteRefrenceController;


class UserController extends SiteRefrenceController {


    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers() {
        $users = json_decode($this->model->getAll(), true);
        if (count($users)) {
            Response::setStatus(200, 'founded users', $users);
        }
    }

    public function createUser() {
        $insertData = Input::getDataJson(true);
        $user = $this->makeClassData($insertData, User::class);
        if (is_object($user)) {
            $checkUser = $this->model->insertUser($user);
            if ($checkUser) {
                return Response::setStatus(200, 'user created', ['status' => $checkUser]);
            }
            return Response::setStatus(400, 'sth wrong while inserting', ['status' => $checkUser]);
        }
        return Response::setStatus(400, 'incomplete data input', []);
    }

    public function getUserById($id) {
        $users = $this->model->getById($id);
        if (count($users)) {
            self::$controllerLog->info('get a user', ['userId' => $id]);
            return Response::setStatus(200, 'founded users', $users);
        }
        return Response::setStatus(200, 'no user found', []);
    }

    public function updateUser($id) {
        $updateData = Input::getDataJson(true);
        $check = $this->model->updateById($updateData, $id);
        if ($check) {
            self::$controllerLog->info('updating a user', ['userId' => $id]);
            return Response::setStatus(200, 'user updated', ['status' => $check]);
        }
        return Response::setStatus(400, 'sth wrong while inserting', ['status' => $check]);
    }
}
