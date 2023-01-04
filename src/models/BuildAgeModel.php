<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class BuildAgeModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'buildage';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('allbuildAge');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(BuildAgeModel::all());
        $redis->store('allbuildAge', $res);
        $redis->expireDate('allbuildAge', 3600);
        return $res;
    }

    //accessor
    public function getValueAttribute($value)
    {
        return strtoupper($value);
    }

    public function getById($id) {
        return BuildAgeModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return BuildAgeModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return BuildAgeModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return BuildAgeModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return BuildAgeModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($range)
    {
        return BuildAgeModel::updateOrInsert(
            ['id' => $range->getId()], ['value' => $range->getValue()]
        );
    }
}
