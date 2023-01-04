<?php
namespace App\Interfaces;

use App\Entities\Entity;

interface Model
{
    public function getById(int $id);

    public function getAll();

    public function getByIds(array $ids);

    public function deleteByIds(array $ids);

    public function deleteById(int $id);

    public function saveOrUpdate($entity);
}
?>