<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class CostEachMeter extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'costeachmeter';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('costEachMeter');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(CostEachMeter::all());
        $redis->store('costEachMeter', $res);
        $redis->expireDate('costEachMeter', 3600);
        return $res;
    }

    public function getById($id) {
        return CostEachMeter::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return CostEachMeter::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return CostEachMeter::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return CostEachMeter::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return CostEachMeter::where('id', $ids)->delete();
    }

    public function saveOrUpdate($range)
    {
        return CostEachMeter::updateOrInsert(
            ['id' => $range->getId()], ['value' => $range->getValue()]
        );
    }
}
