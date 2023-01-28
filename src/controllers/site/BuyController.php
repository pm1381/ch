<?php

namespace App\Controllers\Site;

use App\Helpers\Input;
use App\Classes\Response;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Entities\Buy;

class BuyController extends SiteRefrenceController {


    public function __construct()
    {
        parent::__construct();
    }

    public function getBuys() {
        $buys = json_decode($this->model->getAll(), true);
        if (count($buys)) {
            Response::setStatus(200, 'founded buys', $buys);
        }
    }

    public function createBuy() {
        $insertData = Input::getDataJson(true);
        $buy = $this->makeClassData($insertData, Buy::class);
        if (is_object($buy)) {
            $checkBuy = $this->model->saveOrUpdate($buy);
            if ($checkBuy) {
                return Response::setStatus(200, 'buy created', ['status' => $checkBuy]);
            }
            return Response::setStatus(400, 'sth wrong while inserting', ['status' => $checkBuy]);
        }
        return Response::setStatus(400, 'incomplete data input', []);
    }

    public function getById($id) {
        $buy = $this->model->getById($id);
        if (count($buy)) {
            return Response::setStatus(200, 'founded buy', $buy);
        }
        return Response::setStatus(200, 'no user found', []);
    }

}
