<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class BuildTypeModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'buildtype';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('allBuildType');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(BuildTypeModel::all());
        $redis->store('allBuildType', $res);
        $redis->expireDate('allBuildType', 3600);
        return $res;
    }

    //accessor
    public function getValueAttribute($value)
    {
        return strtoupper($value);
    }

    public function getById($id) {
        return BuildTypeModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return BuildTypeModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return BuildTypeModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return BuildTypeModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return BuildTypeModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($range)
    {
        return BuildTypeModel::updateOrInsert(
            ['id' => $range->getId()], ['value' => $range->getValue()]
        );
    }
}
