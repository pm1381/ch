<?php
namespace App\Models;

trait BaseModel {

    protected $queryCount;
    protected $queryResult;

    public function getCount() {
        return $this->queryCount;
    }

    public function getResult() {
        return $this->queryResult;
    }

}