<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class CoverModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'cover';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        CoverModel::all();
    }

    public function getById($id) {
        return CoverModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return CoverModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return CoverModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return CoverModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return CoverModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        return CoverModel::updateOrInsert(
            ['id' => $data->getId()], ['value' => $data->getValue()]
        );
    }
}
