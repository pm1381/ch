<?php

namespace App\Controllers\Site;

use App\Helpers\Input;
use App\Classes\Response;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Entities\HealthInsurance;

class HealthController extends SiteRefrenceController {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $data = json_decode($this->model->getAll(), true);
        if (count($data)) {
            Response::setStatus(200, 'founded :', $data);
        }
    }

    public function create() {
        $insertData = Input::getDataJson(true);
        $classData = $this->makeClassData($insertData, HealthInsurance::class);
        if (is_object($classData)) {
            $check = $this->model->saveOrUpdate($classData);
            if ($check) {
                return Response::setStatus(200, 'created : ', ['status' => $check]);
            }
            return Response::setStatus(400, 'sth wrong while inserting', ['status' => $check]);
        }
        return Response::setStatus(400, 'incomplete data input', []);
    }

    public function getById($id) {
        $buy = $this->model->getById($id);
        if (count($buy)) {
            return Response::setStatus(200, 'founded : ', $buy);
        }
        return Response::setStatus(200, 'nothing found', []);
    }

}
