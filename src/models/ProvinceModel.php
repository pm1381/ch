<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'name', 'code'];

    public function __construct(){
        $this->table = 'province';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return ProvinceModel::all();
    }

    public function getById($id) {
        return ProvinceModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return ProvinceModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return ProvinceModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return ProvinceModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return ProvinceModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($province)
    {
        $result = ProvinceModel::where('id', $province->getId())->get();
        if (count($result)) {
            return ProvinceModel::where('id', $province->getId())->update(['code' => $province->getCode(), 'name' => $province->getName()]);
        }
        $data = [
            'code' => $province->getCode(),
            'name' => $province->getName()
        ];
        return ProvinceModel::create($data);
    }
}
