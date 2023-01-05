<?php
namespace App\Models;

use App\Entities\UserReminding;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class UserRemindingModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'user', 'date', 'description', 'city', 'remindingPeriod', 'model'];

    public function __construct(){
        $this->table = 'userreminding';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return UserRemindingModel::all();
    }

    public function getById($id) {
        return UserRemindingModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return UserRemindingModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return UserRemindingModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return UserRemindingModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return UserRemindingModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tabledata = [
            'user' => $data->getUser()->getId(),
            'date' => $data->getDate(),
            'description' => $data->getDescription(),
            'city' => $data->getCity()->getId(),
            'model' => $data->getModel()->getId(),
            'remindingPeriod' => $data->getPeriod()
        ];
        $result = UserRemindingModel::where('id', $data->getId())->get();
        if (count($result)) {
            return UserRemindingModel::where('id', $data->getId())->update($tabledata);
        }
        return UserRemindingModel::create($tabledata);
    }
}
