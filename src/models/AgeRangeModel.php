<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class AgeRangeModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'agerange';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('allAgeRange');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(AgeRangeModel::all());
        $redis->store('allAgeRange', $res);
        $redis->expireDate('allAgeRange', 3600);
        return $res;
    }

    //accessor
    public function getValueAttribute($value)
    {
        return strtoupper($value);
    }

    public function getById($id) {
        // i wont erase this one . because it is really handy
        return AgeRangeModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return AgeRangeModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return AgeRangeModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return AgeRangeModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return AgeRangeModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($range)
    {
        return AgeRangeModel::updateOrInsert(
            ['id' => $range->getId()], ['value' => $range->getValue()]
        );
    }
}
