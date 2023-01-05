<?php
namespace App\Models;

use App\Classes\Redis;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class FamilyRelationModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'familyrealtion';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('familyRealtion');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(FamilyRelationModel::all());
        $redis->store('familyRealtion', $res);
        $redis->expireDate('familyRealtion', 3600);
        return $res;
    }

    //accessor
    public function getValueAttribute($value)
    {
        return strtoupper($value);
    }

    public function getById($id) {
        return FamilyRelationModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return FamilyRelationModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return FamilyRelationModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return FamilyRelationModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return FamilyRelationModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($relation)
    {
        return FamilyRelationModel::updateOrInsert(
            ['id' => $relation->getId()], ['value' => $relation->getValue()]
        );
    }
}
