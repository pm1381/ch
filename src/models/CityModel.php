<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class CityModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'province', 'name', 'code'];

    public function __construct(){
        $this->table = 'city';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return CityModel::all();
    }

    public function getById($id) {
        return CityModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return CityModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return CityModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return CityModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return CityModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($city)
    {
        $result = CityModel::where('id', $city->getId())->get();
        if (count($result)) {
            return CityModel::where('id', $city->getId())->update(['code' => $city->getCode(), 'name' => $city->getName(), 'province' => $city->getProvince()->getId()]);
        }
        $data = [
            'code' => $city->getCode(),
            'province' => $city->getProvince()->getId(),
            'name' => $city->getName()
        ];
        return CityModel::create($data);
    }
}
